<?php
session_start();
require_once "../db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$project = $data['project_id'];
$rubric  = $data['rubric_id'];
$grader  = $_SESSION['user_id'];

$total = array_sum(array_column($data['items'], "score"));

$stmt = $pdo->prepare("
  INSERT INTO grades (project_id, rubric_id, grader_id, total_score)
  VALUES (?,?,?,?)
  ON DUPLICATE KEY UPDATE total_score=VALUES(total_score)
");
$stmt->execute([$project, $rubric, $grader, $total]);

echo json_encode(["success" => true, "total" => $total]);
