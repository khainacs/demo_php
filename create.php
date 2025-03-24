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
</head>
<body style="background-color:#f8f9fa; margin:0; font-family:Arial, sans-serif;">
  <div style="max-width:600px; margin:50px auto;">
    <div style="background-color:#fff; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1); overflow:hidden;">
      <div style="background-color:#17a2b8; padding:15px; text-align:center; color:#fff; font-size:20px; font-weight:bold;">
        Add Student
      </div>
      <div style="padding:20px;">
        <form method="POST">
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Student ID:</label>
            <input type="text" name="studentID" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Full Name:</label>
            <input type="text" name="fullName" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Gender:</label>
            <select name="gender" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Birth Date:</label>
            <input type="date" name="birthDate" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Image URL:</label>
            <input type="text" name="imageURL" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Department Code:</label>
            <input type="text" name="departmentCode" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <button type="submit" style="width:100%; padding:10px; background-color:#17a2b8; border:none; border-radius:4px; color:#fff; font-size:16px; cursor:pointer;">
            Add Student
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
