# moodle-gift-quiz-maker
Convert test questions from text into a Moodle-compatible GIFT format.

What if transforming your test questions into Moodle’s GIFT format could be done in seconds, with no manual formatting, no plugins, and no steep learning curve?

The Text2GIFT Converter was built to do exactly that—take plain, human-readable questions and turn them into structured, Moodle-ready GIFT code. It’s fast, lightweight, and efficient, especially when dealing with large sets of questions.

# Why This Tool Exists

Writing GIFT-formatted quizzes manually is time-consuming and error-prone. Moodle supports a wide range of question types, but formatting them correctly—especially in bulk—can become a barrier rather than a tool.

This converter was built to streamline that process. Write your questions the way you normally would, using any text editor. Mark correct answers with an asterisk. The script handles the rest.

It currently supports:
- Single answer questions (only one valid choice, optional negative marking)
- Multiple answer questions (scored proportionally by default)
- Short answer (exact text match)
- Numerical (with optional margin of error)
- Essay (manual grading required)
- True/False (shorthand accepted)

The output is clean, compatible with Moodle’s GIFT import function, and ready to upload.

# Open Source by Design

This project is open source because it should be. The goal is to make quiz creation easier for educators, trainers, and content creators working with Moodle or any GIFT-compatible LMS. There is no proprietary lock-in, no hidden logic, and no usage restrictions.

If you’re using the tool and have an idea for a feature, or if you encounter an edge case in Moodle’s GIFT behavior, contributions and pull requests are welcome. The project is built to be transparent and extensible.

# Acknowledgements

Sincere thanks to Manuel Vilas for developing the original converter.

# How to Use the Text2GIFT Converter

## 1. Write Your Questions
Use any plain text editor (Word, Notepad, LibreOffice, etc.). Each question should follow a simple structure. Mark correct answers with an asterisk (`*`). Create an empty line between the last possible answer and the next question to create a new set of question and answer.

**Examples:**

**Single Answer:**
```
What is the capital of France?
a. Berlin
*b. Paris
c. Madrid
```

**Multiple Answers:**
```
Select all prime numbers:
*a. 2
*b. 3
c. 4
*d. 5
```

**Short Answer:**
```
What is the chemical symbol for water?
*H2O
```

**Numerical:**
```
What is Pi (to two decimals)?
*3.14:0.01
```

**Essay:**
```
Discuss the causes of World War I.
*
```

**True/False:**
```
The sun rises in the west.
*False
```

## 2. Paste into the Converter
Go to the tool interface. Paste your questions into the input box.

## 3. Configure Options (Optional)
- **Question type detection** is automatic, based on structure.
- **Penalty for incorrect answers** (for single/multiple choice) can be set.
- **Feedback and encoding** options are available depending on your needs.
- You can enable file deletion after download for privacy.

## 4. Convert and Download
Click "Convert" to generate the GIFT output.  
Download the `.gift` file. You can open it with a text editor or import directly into Moodle.

## 5. Import into Moodle
In your Moodle course:  
`Question bank > Import > Format: GIFT > Upload file > Import`

Moodle will validate and add your questions to the question bank.
