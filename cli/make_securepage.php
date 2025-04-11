<?php
if (PHP_SAPI !== 'cli') exit("Solo ejecutable desde la terminal.\n");

$argv[1] ??= null;
if (!$argv[1]) {
  echo "❌ Uso: php make_securepage.php NombreArchivo [roles]\n";
  exit;
}

$filename = $argv[1];
$rolesArg = $argv[2] ?? 'admin';
$path = __DIR__ . "/pages/{$filename}.php";

// 🎯 Detecta si hay varios roles separados por coma
if (str_contains($rolesArg, ',')) {
  $rolesCode = '[' . implode(', ', array_map(fn($r) => "'$r'", explode(',', $rolesArg))) . ']';
  $rolesComment = "Acceso autorizado para los roles: <code>$rolesArg</code>";
} else {
  $rolesCode = "'$rolesArg'";
  $rolesComment = "Acceso autorizado para el rol <code>$rolesArg</code>";
}

if (file_exists($path)) {
  echo "⚠️ El archivo ya existe: $path\n";
  exit;
}

$content = <<<PHP
<?php
ob_start();

require '../includes/middleware.php';
require_secure_view($rolesCode);

require '../includes/db.php';
require '../components/layout_start.php';
?>

<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-shield-alt fa-lg text-success"></i>
  <h3 class="m-0 text-success">Página Segura</h3>
</div>

<p class="lead">$rolesComment.</p>

<?php
require '../components/layout_end.php';
ob_end_flush();
?>
PHP;

file_put_contents($path, $content);
echo "✅ Archivo creado exitosamente: pages/{$filename}.php\n";