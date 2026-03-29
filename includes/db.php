<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!function_exists('load_env_file')) {
  function resolve_env_placeholders(string $value): string {
    return (string) preg_replace_callback(
      '/\$\{\{\s*([A-Z0-9_]+)\s*\}\}|\$\{([A-Z0-9_]+)\}/i',
      static function (array $matches): string {
        $key = $matches[1] !== '' ? $matches[1] : $matches[2];
        $resolved = getenv($key);

        if ($resolved === false) {
          $resolved = $_ENV[$key] ?? $_SERVER[$key] ?? null;
        }

        return is_string($resolved) ? $resolved : $matches[0];
      },
      $value
    );
  }

  function load_env_file(string $path): void {
    if (!is_readable($path)) {
      return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
      return;
    }

    foreach ($lines as $line) {
      $line = trim($line);

      if ($line === '' || str_starts_with($line, '#')) {
        continue;
      }

      $separatorPos = strpos($line, '=');
      if ($separatorPos === false) {
        continue;
      }

      $key = trim(substr($line, 0, $separatorPos));
      $value = trim(substr($line, $separatorPos + 1));

      if ($key === '' || getenv($key) !== false) {
        continue;
      }

      if (
        (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
        (str_starts_with($value, "'") && str_ends_with($value, "'"))
      ) {
        $value = substr($value, 1, -1);
      }

      $value = resolve_env_placeholders($value);

      putenv("$key=$value");
      $_ENV[$key] = $value;
      $_SERVER[$key] = $value;
    }
  }
}

if (!function_exists('env_value')) {
  function env_value(string $key, ?string $default = null): ?string {
    $value = getenv($key);
    if ($value !== false && $value !== '') {
      return $value;
    }

    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
      return (string) $_ENV[$key];
    }

    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
      return (string) $_SERVER[$key];
    }

    return $default;
  }
}

if (!function_exists('parse_database_url')) {
  function parse_database_url(string $url): array {
    $parts = parse_url($url);
    if ($parts === false) {
      return [];
    }

    return [
      'host' => $parts['host'] ?? null,
      'port' => isset($parts['port']) ? (string) $parts['port'] : null,
      'database' => isset($parts['path']) ? ltrim($parts['path'], '/') : null,
      'username' => $parts['user'] ?? null,
      'password' => $parts['pass'] ?? null,
    ];
  }
}

if (!function_exists('has_unresolved_placeholder')) {
  function has_unresolved_placeholder(?string $value): bool {
    if ($value === null || $value === '') {
      return false;
    }

    return preg_match('/\$\{\{.+\}\}|\$\{.+\}/', $value) === 1;
  }
}

load_env_file(__DIR__ . '/../.env');

$config = [
  'host' => 'localhost',
  'port' => '3306',
  'database' => 'report_dashboard',
  'username' => 'root',
  'password' => '',
  'charset' => 'utf8mb4',
];

$databaseUrl = env_value('MYSQL_URL') ?? env_value('DATABASE_URL');
$hasResolvedDatabaseUrl = $databaseUrl !== null && !has_unresolved_placeholder($databaseUrl);
$hasResolvedMysqlHost = !has_unresolved_placeholder(env_value('MYSQLHOST'));

if ($hasResolvedDatabaseUrl) {
  $config = array_merge($config, array_filter(parse_database_url($databaseUrl), static fn ($value) => $value !== null && $value !== ''));
}

$dbHost = env_value('DB_HOST');
$dbPort = env_value('DB_PORT');
$dbDatabase = env_value('DB_DATABASE');
$dbUsername = env_value('DB_USERNAME');
$dbPassword = env_value('DB_PASSWORD');

if ($hasResolvedMysqlHost) {
  $config['host'] = env_value('MYSQLHOST', $config['host']);
  $config['port'] = env_value('MYSQLPORT', $config['port']);
  $config['database'] = env_value('MYSQLDATABASE', $config['database']);
  $config['username'] = env_value('MYSQLUSER', $config['username']);
  $config['password'] = env_value('MYSQLPASSWORD', $config['password']);
}

$config['host'] = $dbHost ?? $config['host'];
$config['port'] = $dbPort ?? $config['port'];
$config['database'] = $dbDatabase ?? $config['database'];
$config['username'] = $dbUsername ?? $config['username'];
$config['password'] = $dbPassword ?? $config['password'];
$config['charset'] = env_value('DB_CHARSET', $config['charset']);

try {
  $conn = mysqli_init();

  if ($conn === false) {
    throw new RuntimeException('No se pudo inicializar mysqli.');
  }

  $conn->real_connect(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['database'],
    (int) $config['port']
  );
  $conn->set_charset($config['charset']);
} catch (Throwable $e) {
  error_log('Database connection failed: ' . $e->getMessage());
  die('❌ Error de conexión a base de datos. Revisa la configuración del entorno.');
}
