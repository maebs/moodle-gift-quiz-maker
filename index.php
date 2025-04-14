<?php if (!empty($_GET['file'])): ?>
<div class="alert alert-success mt-4">
    <i class="fas fa-check-circle"></i> GIFT file generated.
    <a href="download.php?file=<?= htmlspecialchars($_GET['file']) ?><?= isset($_GET['delete']) ? '&delete=1' : '' ?>">Download here</a>.
</div>
<?php endif; ?>
