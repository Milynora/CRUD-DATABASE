<?php
include "components/pdo.php";

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();

$status = $_GET["status"] ?? "";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f4f7fb; }
.custom-card { border: none; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
.table thead { background-color: #f1f3f7; }
.btn-custom { border-radius: 10px; font-weight: 500; }
</style>
</head>
<body>

<div class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Users List</h3>
    <div class="d-flex gap-2">
      <a href="add.php" class="btn btn-primary btn-custom">+ Add</a>
      <form method="post" action="delete.php" onsubmit="return confirm('Delete all users?');">
        <input type="hidden" name="action" value="delete_all">
        <button class="btn btn-outline-danger btn-custom">Delete All</button>
      </form>
    </div>
  </div>

  <div class="card custom-card p-4">

    <?php if (count($users) > 0): ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                <td class="fw-semibold"><?= htmlspecialchars($user["id"]) ?></td>
                <td><?= htmlspecialchars($user["firstname"]) ?></td>
                <td><?= htmlspecialchars($user["lastname"]) ?></td>
                <td class="text-end">
                  <a href="update.php?id=<?= $user["id"] ?>" class="btn btn-sm btn-outline-primary btn-custom">Edit</a>
                  <form method="post" action="delete.php" class="d-inline" onsubmit="return confirm('Delete this user?');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user["id"]) ?>">
                    <button class="btn btn-sm btn-outline-danger btn-custom">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="text-center py-5">
        <p class="text-muted">No users found.</p>
        <a href="add.php" class="btn btn-primary btn-custom">Add First User</a>
      </div>
    <?php endif; ?>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php if ($status): ?>
<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 11">
  <?php 
  $toastClass = "text-bg-success"; 
  if ($status === "deleted" || $status === "all_deleted") $toastClass = "text-bg-danger"; 
  if ($status === "empty") $toastClass = "text-bg-warning"; 
  ?>
  <div id="liveToast" class="toast align-items-center <?= $toastClass ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex justify-content-center">
      <div class="toast-body text-center" style="font-size: 1.1rem; padding: 1rem 1.5rem;">
        <?php
        if ($status==="added") echo "User added successfully.";
        elseif ($status==="updated") echo "User updated successfully.";
        elseif ($status==="deleted") echo "User deleted successfully.";
        elseif ($status==="all_deleted") echo "All users deleted.";
        elseif ($status==="empty") echo "Please fill in all fields.";
        ?>
      </div>
    </div>
  </div>
</div>

<script>
var toastEl = document.getElementById('liveToast');
var toast = new bootstrap.Toast(toastEl, { delay: 2000 });
toast.show();
</script>
<?php endif; ?>

</body>
</html>