<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST["studentID"];
    $fullName = $_POST["fullName"];
    $gender = $_POST["gender"];
    $birthDate = $_POST["birthDate"];
    $imageURL = $_POST["imageURL"];
    $departmentCode = $_POST["departmentCode"];

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
            VALUES ('$studentID', '$fullName', '$gender', '$birthDate', '$imageURL', '$departmentCode')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
      <a class="navbar-brand" href="index.php">Student Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="courses.php">Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Add Student Form -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow">
          <div class="card-header bg-info text-white text-center">
            Add Student
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Student ID:</label>
                <input type="text" name="studentID" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Full Name:</label>
                <input type="text" name="fullName" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Gender:</label>
                <select name="gender" class="form-select">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Birth Date:</label>
                <input type="date" name="birthDate" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Image URL:</label>
                <input type="text" name="imageURL" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Department Code:</label>
                <input type="text" name="departmentCode" class="form-control">
              </div>
              <button type="submit" class="btn btn-info w-100 text-white">Add Student</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
