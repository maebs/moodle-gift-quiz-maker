<?php
$version = '0.0.5';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = trim($_POST['questions']);
    $penalty = (int) ($_POST['penalty'] ?? 0);
    $identifier = trim($_POST['identifier'] ?? '');
    $filename = basename($_POST['filename']) ?: 'gift_output.txt';
    $singlePenalty = trim($_POST['single_penalty'] ?? '');
    $multiPenalty = trim($_POST['multi_penalty'] ?? '');
    $deleteFlag = isset($_POST['delete_after_download']) ? '&delete=1' : '';

    $lines = preg_split('/\r\n|\r|\n/', $input);
    $questions = [];
    $current = [];

    foreach ($lines as $line) {
        if (trim($line) === '') {
            if (!empty($current)) {
                $questions[] = $current;
                $current = [];
            }
        } else {
            $current[] = trim($line);
        }
    }
    if (!empty($current)) $questions[] = $current;

    $gift = '';
    $gift .= "// Converter Version: $version\n";
    if ($identifier !== '') {
        $gift .= "// Exam ID: $identifier\n";
    }

    foreach ($questions as $qset) {
        $question = array_shift($qset);
        $answers = [];
        $correctCount = 0;
        $isEssay = false;
        $isNumerical = false;
        $isTF = false;

        foreach ($qset as $a) {
            if ($a === '*') {
                $isEssay = true;
            } elseif (preg_match('/^\*(True|False|T|F|\+|\-)$/i', $a)) {
                $isTF = true;
                $answers[] = strtoupper(trim($a, '* '));
            } elseif (preg_match('/^\*(.*?):(\d+(\.\d+)?)$/', $a, $matches)) {
                $isNumerical = true;
                $answers[] = ['value' => $matches[1], 'margin' => $matches[2]];
            } else {
                $isCorrect = str_starts_with($a, '*');
                if ($isCorrect) {
                    $correctCount++;
                    $answers[] = ['text' => substr($a, 1), 'correct' => true];
                } else {
                    $answers[] = ['text' => $a, 'correct' => false];
                }
            }
        }

        $gift .= "\n";
        $gift .= "::" . substr(md5($question), 0, 8) . ":: $question {";

        if ($isEssay) {
            $gift .= "}\n";
            continue;
        } elseif ($isTF) {
            $gift .= strtoupper($answers[0]) === 'TRUE' || $answers[0] === '+' || $answers[0] === 'T' ? "T" : "F";
        } elseif ($isNumerical) {
            $gift .= "#" . $answers[0]['value'] . ":" . $answers[0]['margin'];
        } elseif ($correctCount === 1) {
            foreach ($answers as $ans) {
                if ($ans['correct']) {
                    $gift .= "=" . $ans['text'] . "\n";
                } else {
                    $gift .= ($singlePenalty == '' ? "~" : "~%-{$singlePenalty}%") . $ans['text'] . "\n";
                }
            }
        } elseif ($correctCount > 1) {
            foreach ($answers as $ans) {
                if ($ans['correct']) {
                    $pct = 100 / $correctCount;
                    $gift .= "~%{$pct}%{$ans['text']}\n";
                } else {
                    $gift .= ($multiPenalty == '' ? "~" : "~%-{$multiPenalty}%") . $ans['text'] . "\n";
                }
            }
        }

        $gift .= "}\n";
    }

    file_put_contents($filename, $gift);
    header("Location: index.php?file=" . urlencode($filename) . $deleteFlag);
    exit;
}
?>