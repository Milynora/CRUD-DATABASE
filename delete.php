<?php
include "components/pdo.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: view.php");
    exit;
}

$action = $_POST["action"] ?? "";

if ($action === "delete_all") {
    $pdo->exec("DELETE FROM users");
    header("Location: view.php?status=all_deleted");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: view.php?status=deleted");
    exit;
}

header("Location: view.php");
exit;