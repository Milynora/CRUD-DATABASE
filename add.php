<?php
include 'components/pdo.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstname = trim($_POST["firstname"] ?? "");
    $lastname  = trim($_POST["lastname"] ?? "");

    if ($firstname === "" || $lastname === "") {
        header("Location: view.php?status=empty");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname) VALUES (?, ?)");
    $stmt->execute([$firstname, $lastname]);

    header("Location: view.php?status=added");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f4f7fb; }
.custom-card { border: none; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
.btn-custom { border-radius: 12px; padding: 12px; font-weight: 600; }
</style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card custom-card p-4">
        <h3 class="fw-bold mb-4 text-center">Add New User</h3>

        <form method="post">
          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control form-control-lg" required>
          </div>

          <div class="mb-4">
            <label class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control form-control-lg" required>
          </div>

          <div class="d-grid gap-2">
            <button class="btn btn-primary btn-custom">Save User</button>
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