<?php

require_once '../Models/Informations.php';
require_once '../Services/InformationsService.php';



// Lấy dữ liệu từ form
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$birthdayDay = $_POST['birthday_day'];
$birthdayMonth = $_POST['birthday_month'];
$birthdayYear = $_POST['birthday_year'];
$address = $_POST['address'];

$formData = array(
    'username' => $fullName,
    'email' => $email,
    'number_phone' => $phone,
    'birthday' => $birthdayYear . '-' . $birthdayMonth . '-' . $birthdayDay,
    'address' => $address
);


$InformationsService = new InformationsService();
$InformationsService->insertDB($formData);
// Kiểm tra kết quả và hiển thị thông báo tương ứng
if ($InformationsService) {
    return json_encode(['success' => true]);
} else {
    return json_encode(['success' => true]);
}

// Đóng kết nối
// $conn->close();
?>
