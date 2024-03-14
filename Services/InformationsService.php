<?php

require_once '../Database/db.php';
require_once '../Models/Informations.php';


class InformationsService {

    private $db;
    public function __construct()
    {
        $this->db = db::getInstance();
        
    }

    public function getUserByEmail($email){
        // Chuẩn bị câu lệnh SQL
        $query = "SELECT * FROM informations WHERE email = ?";
        
        // Chuẩn bị và thực thi câu lệnh SQL bằng prepared statement
        $stmt = $this->db->prepare($query);
        
        // Kiểm tra nếu câu lệnh SQL đã được chuẩn bị thành công
        if ($stmt) {
            // Truyền giá trị vào câu lệnh SQL bằng phương thức bind_param()
            $stmt->bind_param("s", $email);
            
            // Thực thi câu lệnh SQL
            $stmt->execute();
            
            // Lấy kết quả từ câu lệnh SQL
            $result = $stmt->get_result();
            
            // Trả về kết quả
            return $result->fetch_assoc();
        } else {
            // Nếu có lỗi xảy ra trong quá trình chuẩn bị câu lệnh SQL, trả về null
            return null;
        }
    }

    public function insertDB(array $data){
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $check = $this->getUserByEmail($data['email']);
        
        // Nếu email chưa tồn tại, thêm mới dữ liệu vào cơ sở dữ liệu
        if($check === null){
            // Chuẩn bị câu lệnh SQL để chèn dữ liệu mới vào cơ sở dữ liệu
            $query = "INSERT INTO informations (username, email, number_phone, birthday, address, created_at) 
                      VALUES (?, ?, ?, ?, ?, NOW())";
        }
        else{
            // Chuẩn bị câu lệnh SQL để cập nhật dữ liệu đã tồn tại trong cơ sở dữ liệu
            $query = "UPDATE informations 
                      SET username = ?, number_phone = ?, birthday = ?, address = ?, updated_at = NOW() 
                      WHERE email = ?";
        }
    
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->db->prepare($query);
        
        // Kiểm tra nếu câu lệnh SQL đã được chuẩn bị thành công
        if ($stmt) {
            // Truyền các giá trị vào câu lệnh SQL bằng phương thức bind_param()
            if ($check === null) {
                $stmt->bind_param("sssss", $data['username'], $data['email'], $data['number_phone'], $data['birthday'], $data['address']);
            } else {
                $stmt->bind_param("sssss", $data['username'], $data['number_phone'], $data['birthday'], $data['address'], $data['email']);
            }
            
            // Thực thi câu lệnh SQL
            if ($stmt->execute()) {
                return true; // Trả về true nếu thêm hoặc cập nhật dữ liệu thành công
            } else {
                return false; // Trả về false nếu có lỗi xảy ra
            }
        } else {
            return false; // Trả về false nếu câu lệnh SQL không được chuẩn bị thành công
        }
    }

    
}