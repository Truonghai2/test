


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin liên lạc</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body style="background: #f1f1f1;">
    <div id="wrapper">
        <div class="form-inp-information">
        <div class="content">
            <div class="header-content title">
                <h1>Lưu thông tin liên hệ</h1>
            </div>
            <div class="main-content">
                <form id="contactForm" action="./Controllers/saveInformation.php" method="POST">
                    <div class="username">
                        <label for="fullName">Tên người dùng:</label>
                        <input type="text" id="fullName"  autocomplete="off" name="fullName" placeholder="Nhập tên người dùng" required>
                    </div>
                    <div class="email">
                        <label for="email">Email:</label>
                        <input type="email"  autocomplete="off" id="email" name="email" placeholder="nhập email người dùng" required>
                    </div>
                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" id="phone" name="phone"  autocomplete="off" placeholder="Nhập số điện thoại người dùng" required>
                    <label for="" >Ngày sinh:</label><br>

                    <div class="birthday">
                        
                        <select class="item day" name="birthday_day" id="birthday_day" required>
                            <option value="">Ngày</option>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>

                        <select class="item month" name="birthday_month" id="birthday_month" required>
                            <option value="">Tháng</option>
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?php echo $i; ?>">Tháng <?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>

                        <select class="item year" name="birthday_year" id="birthday_year" required>
                            <option value="">Năm</option>
                            <?php for ($i = date('Y'); $i >= date('Y') - 100; $i--): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="address">
                        <label for="address">Địa chỉ: </label>
                        <input type="text" name="address" id="address" placeholder="Nhập địa chỉ người dùng"  autocomplete="off" required>
                        
                    </div>


                    <input name="submit" type="submit" value="Lưu">
                </form>
            </div>
        </div>
        </div>
       
    </div>

    <script>
       $(document).ready(function() {
        $('#contactForm').submit(function(event) {
            // Ngăn chặn việc gửi biểu mẫu mặc định
            event.preventDefault();

            // Kiểm tra các trường dữ liệu trước khi gửi
            var fullName = $('#fullName').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var birthday_day = $('#birthday_day').val();
            var birthday_month = $('#birthday_month').val();
            var birthday_year = $('#birthday_year').val();
            var address = $('#address').val();

            // Kiểm tra xem các trường đã được nhập đầy đủ hay không
            if (fullName == '' || email == '' || phone == '' || birthday_day == '' || birthday_month == '' || birthday_year == '' || address == '') {
                alert('Vui lòng điền đầy đủ thông tin.');
                return;
            }

            // Thực hiện gửi dữ liệu thông qua AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(), // Sử dụng phương thức serialize để lấy dữ liệu từ biểu mẫu
                success: function(response) {
                    // Xử lý phản hồi từ máy chủ
                    console.log(response);
                    alert('Dữ liệu đã được gửi thành công.');
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    console.error(xhr.responseText);
                    alert('Có lỗi xảy ra khi gửi dữ liệu.');
                }
            });
        });
    });

    </script>
</body>
</html>