<?php
require_once "../db.php";
header("Content-Type: application/json");

$stmt = $pdo->query("
  SELECT p.id, p.title, c.code AS course_code
  FROM projects p
  JOIN courses c ON p.course_id = c.id
");
echo json_encode($stmt->fetchAll());
