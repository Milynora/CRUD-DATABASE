<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #eef2f7, #d9e4f5);
      min-height: 100vh;
      display: flex;
      align-items: center;
    }
    .custom-card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .btn-custom {
      border-radius: 12px;
      padding: 12px;
      font-weight: 600;
    }
  </style>
</head>

<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card custom-card p-5 text-center">
        <h2 class="fw-bold mb-3">User Management</h2>
        <p class="text-muted mb-4">
          Your all-in-one user management solution.
        </p>

        <div class="d-grid gap-3">
          <a href="view.php" class="btn btn-primary btn-custom">View Users</a>
          <a href="add.php" class="btn btn-outline-primary btn-custom">Add New User</a>
        </div>

      </div>

    </div>
  </div>
</div>

</body>
</html>