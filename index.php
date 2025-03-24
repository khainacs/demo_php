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
</head>
<body style="background-color:#f8f9fa; margin:0; font-family:Arial, sans-serif;">

  <!-- Navigation Bar -->
  <nav style="background-color:#007bff; color:#fff; padding:10px 20px; display:flex; justify-content:space-between; align-items:center;">
    <div>
      <a href="index.php" style="color:#fff; text-decoration:none; font-size:20px;">Student Portal</a>
    </div>
  </nav>

  <!-- Main Content -->
  <div style="max-width:1200px; margin:20px auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
      <h2 style="color:#007bff; font-weight:bold;">Danh sách sinh viên</h2>
      <a href="create.php" style="padding:10px 20px; background-color:#007bff; color:#fff; text-decoration:none; border-radius:25px;">Thêm sinh viên</a>
    </div>
    <div style="display:flex; flex-wrap:wrap;">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div style="width:23%; margin:1%; background-color:#fff; box-shadow:0 2px 5px rgba(0,0,0,0.1); border-radius:5px; overflow:hidden;">
          <?php 
              $imagePath = "public/images/" . htmlspecialchars($row['Hinh']);
              if (!empty($row['Hinh']) && file_exists($imagePath)) {
                $imgSrc = $imagePath;
              } else {
                $imgSrc = "public/images/default.jpg";
              }
          ?>
          <img src="<?= $imgSrc ?>" alt="Hình sinh viên" style="width:100%; height:200px; object-fit:cover;">
          <div style="padding:10px;">
              <h5 style="margin:5px 0; font-size:18px; color:#333;"><?= htmlspecialchars($row['HoTen']) ?></h5>
              <p style="margin:5px 0; font-size:14px; color:#555;"><strong>Mã SV:</strong> <?= htmlspecialchars($row['MaSV']) ?></p>
              <p style="margin:5px 0; font-size:14px; color:#555;"><strong>Giới tính:</strong> <?= htmlspecialchars($row['GioiTinh']) ?></p>
              <p style="margin:5px 0; font-size:14px; color:#555;"><strong>Ngày sinh:</strong> <?= htmlspecialchars($row['NgaySinh']) ?></p>
              <p style="margin:5px 0; font-size:14px; color:#555;"><strong>Mã Ngành:</strong> <?= htmlspecialchars($row['MaNganh']) ?></p>
          </div>
          <div style="padding:10px; display:flex; justify-content:space-between; border-top:1px solid #eee;">
              <a href="pages/detail.php?MaSV=<?= urlencode($row['MaSV']) ?>" style="text-decoration:none; color:#007bff;">Xem</a>
              <a href="pages/edit.php?MaSV=<?= urlencode($row['MaSV']) ?>" style="text-decoration:none; color:#fff; background-color:#ffc107; padding:5px 10px; border-radius:25px; font-size:12px;">Sửa</a>
              <a href="pages/delete.php?MaSV=<?= urlencode($row['MaSV']) ?>" onclick="return confirm('Bạn có chắc muốn xóa?')" style="text-decoration:none; color:#fff; background-color:#dc3545; padding:5px 10px; border-radius:25px; font-size:12px;">Xóa</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

</body>
</html>
