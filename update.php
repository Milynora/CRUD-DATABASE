<?php
include "components/pdo.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $firstname = trim($_POST["firstname"] ?? "");
    $lastname  = trim($_POST["lastname"] ?? "");

    if ($firstname && $lastname) {
        $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE id = ?");
        $stmt->execute([$firstname, $lastname, $id]);
        header("Location: view.php?status=updated");
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Update User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f4f7fb; }
.custom-card { border:none; border-radius:20px; box-shadow:0 8px 25px rgba(0,0,0,0.08); }
.btn-custom { border-radius:12px; font-weight:600; }
</style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card custom-card p-4">
        <h3 class="fw-bold mb-4 text-center">Update User</h3>

        <form method="post">
          <input type="hidden" name="id" value="<?= htmlspecialchars($user["id"]) ?>">

          <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="firstname"
                   value="<?= htmlspecialchars($user["firstname"]) ?>"
                   class="form-control form-control-lg" required>
          </div>

          <div class="mb-4">
            <label>Last Name</label>
            <input type="text" name="lastname"
                   value="<?= htmlspecialchars($user["lastname"]) ?>"
                   class="form-control form-control-lg" required>
          </div>

          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-custom">Update</button>
            <a href="view.php" class="btn btn-outline-secondary btn-custom">Back</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>