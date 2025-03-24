<?php
include 'config.php';

// Xử lý form POST (thực hiện xóa)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['MaSV'];

    $checkQuery = $conn->prepare("SELECT Hinh FROM SinhVien WHERE MaSV = ?");
    $checkQuery->bind_param("s", $maSV);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = "public/images/" . basename($row['Hinh']);

        $conn->begin_transaction();
        try {
            $deleteDangKy = $conn->prepare("DELETE FROM DangKy WHERE MaSV = ?");
            $deleteDangKy->bind_param("s", $maSV);
            $deleteDangKy->execute();

            $deleteSinhVien = $conn->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
            $deleteSinhVien->bind_param("s", $maSV);
            $deleteSinhVien->execute();

            if (!empty($row['Hinh']) && file_exists($imagePath) && $row['Hinh'] !== 'default.png') {
                unlink($imagePath);
            }

            $conn->commit();
            echo "<script>alert('Xóa sinh viên thành công!'); window.location.href='index.php';</script>";
            exit;
        } catch (Exception $e) {
            $conn->rollback();
            echo "<script>alert('Lỗi khi xóa sinh viên!'); window.location.href='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Không tìm thấy sinh viên!'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    // GET: Hiển thị trang xác nhận xóa
    if (isset($_GET['MaSV'])) {
        $maSV = $_GET['MaSV'];
        $stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
        $stmt->bind_param("s", $maSV);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
        } else {
            echo "<script>alert('Không tìm thấy sinh viên!'); window.location.href='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Thiếu thông tin sinh viên!'); window.location.href='index.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xác nhận xóa sinh viên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #dc3545 !important;
    }
    .navbar .nav-link {
      color: #fff !important;
      font-weight: 500;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color: #dc3545;
      color: #fff;
      font-size: 1.5rem;
      text-align: center;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .btn-danger {
      border-radius: 50px;
      padding: 10px 20px;
    }
    .btn-secondary {
      border-radius: 50px;
      padding: 10px 20px;
    }
    .confirm-img {
      border: 2px solid #dc3545;
      padding: 5px;
      border-radius: 15px;
      max-width: 200px;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">Student Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sinh viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hocphan.php">Học phần</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Đăng ký</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Đăng nhập</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Xác nhận xóa sinh viên -->
  <div class="container my-5">
    <div class="card mx-auto" style="max-width: 600px;">
      <div class="card-header">
        Xác nhận xóa sinh viên
      </div>
      <div class="card-body text-center">
        <div class="mb-3">
          <img src="public/images/<?= htmlspecialchars($student['Hinh']) ?>" alt="Hình sinh viên" class="img-fluid confirm-img">
        </div>
        <h4 class="mb-3"><?= htmlspecialchars($student['HoTen']) ?></h4>
        <p class="mb-4">Bạn có chắc muốn xóa sinh viên này không?</p>
        <form method="POST">
          <input type="hidden" name="MaSV" value="<?= htmlspecialchars($student['MaSV']) ?>">
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-danger me-3">Xóa</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
