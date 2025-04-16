<?php
require '../includes/db.php';

$data = [
  'labels' => ["Ene", "Feb", "Mar", "Abr", "May"],
  'values' => [1200, 1500, 1800, 1100]
];

echo json_encode($data);
