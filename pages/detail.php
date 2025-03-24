<?php
include '../config.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

// Lấy tên ngành từ bảng NganhHoc
$query_nganh = "SELECT TenNganh FROM NganhHoc WHERE MaNganh = '{$row['MaNganh']}'";
$result_nganh = $conn->query($query_nganh);
$row_nganh = $result_nganh->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thông Tin Sinh Viên</title>
</head>
<body style="background-color: #f8f9fa; margin: 0; font-family: Arial, sans-serif;">

  <!-- Navigation Bar -->
  <nav style="background-color: #343a40; color: #fff; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
      <a href="index.php" style="color: #fff; text-decoration: none; font-size: 20px;">Portal Sinh Viên</a>
    </div>
    <div>
      <a href="index.php" style="color: #fff; text-decoration: none; margin-right: 15px;">Trang Chủ</a>
      <a href="hocphan.php" style="color: #fff; text-decoration: none; margin-right: 15px;">Học Phần</a>
      <a href="register.php" style="color: #fff; text-decoration: none; margin-right: 15px;">Đăng Ký</a>
      <a href="login.php" style="color: #fff; text-decoration: none;">Đăng Nhập</a>
    </div>
  </nav>

  <!-- Main Content -->
  <div style="max-width: 800px; margin: 40px auto;">
    <h2 style="text-align: center; color: #333; margin-bottom: 20px;">Thông Tin Chi Tiết Sinh Viên</h2>
    <div style="background-color: #fff; border-radius: 15px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 20px;">
      <div style="display: flex; flex-wrap: wrap; align-items: center;">
        <!-- Ảnh sinh viên -->
        <div style="flex: 1; min-width: 200px; text-align: center; margin-bottom: 20px;">
          <?php 
            $imagePath = "public/images/" . htmlspecialchars($row['Hinh']);
            $imgSrc = (!empty($row['Hinh']) && file_exists($imagePath)) ? $imagePath : "public/images/images_1.jpg";
          ?>
          <img src="http://localhost/demo_php/<?= $imgSrc ?>" alt="Hình sinh viên" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
        </div>
        <!-- Thông tin chi tiết -->
        <div style="flex: 2; min-width: 250px;">
          <dl style="margin: 0;">
            <dt style="font-weight: bold; margin: 5px 0;">Mã Sinh Viên:</dt>
            <dd style="margin: 5px 0;"><?= htmlspecialchars($row['MaSV']) ?></dd>

            <dt style="font-weight: bold; margin: 5px 0;">Họ và Tên:</dt>
            <dd style="margin: 5px 0;"><?= htmlspecialchars($row['HoTen']) ?></dd>

            <dt style="font-weight: bold; margin: 5px 0;">Giới Tính:</dt>
            <dd style="margin: 5px 0;"><?= htmlspecialchars($row['GioiTinh']) ?></dd>

            <dt style="font-weight: bold; margin: 5px 0;">Ngày Sinh:</dt>
            <dd style="margin: 5px 0;"><?= htmlspecialchars($row['NgaySinh']) ?></dd>

            <dt style="font-weight: bold; margin: 5px 0;">Ngành Học:</dt>
            <dd style="margin: 5px 0;"><?= htmlspecialchars($row['MaNganh']) ?> - <?= htmlspecialchars($row_nganh['TenNganh']) ?></dd>
          </dl>
        </div>
      </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
      <a href="index.php" style="text-decoration: none; padding: 10px 20px; border: 1px solid #343a40; color: #343a40; border-radius: 5px;">Quay Lại</a>
    </div>
  </div>

</body>
</html>
