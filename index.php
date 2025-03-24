<?php
include 'config.php';
$result = $conn->query("SELECT SinhVien.MaSV, SinhVien.HoTen, SinhVien.GioiTinh, SinhVien.NgaySinh, SinhVien.Hinh, NganhHoc.MaNganh 
                        FROM SinhVien 
                        LEFT JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách sinh viên</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
            <a class="nav-link" href="login.php">Đăng Nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Đăng Kí</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary fw-bold">Danh sách sinh viên</h2>
      <a href="create.php" class="btn btn-primary rounded-pill">Thêm sinh viên</a>
    </div>
    <div class="row">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card h-100 shadow-sm">
            <?php 
              $imagePath = "public/images/" . htmlspecialchars($row['Hinh']);
              if (!empty($row['Hinh']) && file_exists($imagePath)) {
                $imgSrc = $imagePath;
              } else {
                $imgSrc = "public/images/default.jpg";
              }
            ?>
            <img src="<?= $imgSrc ?>" alt="Hình sinh viên" class="card-img-top" style="height:200px; object-fit:cover;">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['HoTen']) ?></h5>
              <p class="card-text mb-1"><strong>Mã SV:</strong> <?= htmlspecialchars($row['MaSV']) ?></p>
              <p class="card-text mb-1"><strong>Giới tính:</strong> <?= htmlspecialchars($row['GioiTinh']) ?></p>
              <p class="card-text mb-1"><strong>Ngày sinh:</strong> <?= htmlspecialchars($row['NgaySinh']) ?></p>
              <p class="card-text"><strong>Mã Ngành:</strong> <?= htmlspecialchars($row['MaNganh']) ?></p>
            </div>
            <div class="card-footer bg-transparent border-top-0">
              <div class="d-flex justify-content-between">
                <a href="detail.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-success rounded-pill btn-sm">Xem</a>
                <a href="edit.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-warning rounded-pill btn-sm">Sửa</a>
                <a href="delete.php?MaSV=<?= urlencode($row['MaSV']) ?>" class="btn btn-danger rounded-pill btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
