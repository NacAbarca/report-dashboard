<?php
$current_url = $_SERVER['PHP_SELF'];
$breadcrumbs = [];

foreach ($menu as $item) {
  if (isset($item['title'], $item['url']) && strpos($current_url, $item['url']) !== false) {
    // Home breadcrumb
    $breadcrumbs[] = [
      'label' => '<i class="fas fa-home me-1"></i>Inicio',
      'url' => '/index.php'
    ];

    // If not home, append actual item
    if ($item['url'] !== '/index.php') {
      $breadcrumbs[] = [
        'label' => $item['title']
      ];
    }
    break;
  }
}
?>

<?php if (!empty($breadcrumbs)): ?>
<nav class="d-none d-md-block" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb bg-white px-3 py-2 rounded shadow-sm small mb-4">
    <?php foreach ($breadcrumbs as $i => $crumb): ?>
      <?php if (isset($crumb['url'])): ?>
        <li class="breadcrumb-item">
          <a href="<?= $crumb['url'] ?>" class="text-decoration-none text-primary fw-medium">
            <?= $crumb['label'] ?>
          </a>
        </li>
      <?php else: ?>
        <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
          <?= $crumb['label'] ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ol>
</nav>
<?php endif; ?>
