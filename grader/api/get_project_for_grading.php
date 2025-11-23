<?php
require_once "../db.php";
header("Content-Type: application/json");

$id = $_GET['id'];

$project = $pdo->prepare("SELECT * FROM projects WHERE id=?");
$project->execute([$id]);
$project = $project->fetch();

$rubric = $pdo->prepare("SELECT * FROM rubrics WHERE course_id=? LIMIT 1");
$rubric->execute([$project['course_id']]);
$rubric = $rubric->fetch();

$crit = $pdo->prepare("SELECT * FROM rubric_criteria WHERE rubric_id=?");
$crit->execute([$rubric['id']]);
$criteria = $crit->fetchAll();

echo json_encode([
  "project" => $project,
  "rubric_id" => $rubric['id'],
  "criteria" => $criteria
]);
