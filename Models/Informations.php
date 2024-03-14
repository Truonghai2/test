<?php

require_once '../Database/db.php';

class Informations{
    private $id;
    private $email;
    private $username;
    private $number_phone;
    private $birthday;
    private $address;
    private $created_at;
    private $updated_at;
    private $db;

    public function __construct( $email, $username, $number_phone, $birthday, $address, $created_at,$updated_at = null)
    {
        $this->email = $email;
        $this->username = $username;
        $this->number_phone = $number_phone;
        $this->birthday = $birthday;
        $this->address = $address;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        
    }

    public function getEmail(){
        return $this->email;
    }

    public function getUserName(){
        return $this->username;
    }

    public function getNumberPhone(){
        return $this->number_phone;
    }

    public function getBirthDay(){
        return $this->birthday;
    }
    public function getAddress(){
        return $this->address;
    }

    public function All(){
        // Khai báo mảng để lưu trữ tất cả thông tin
        $allInformations = array();
    
        // Truy vấn SQL để lấy tất cả thông tin từ bảng informations
        $query = "SELECT * FROM informations";
        
        // Thực hiện truy vấn
        $result = $this->db->query($query);
    
        // Kiểm tra xem truy vấn có thành công không
        if ($result) {
            // Duyệt qua từng dòng kết quả và thêm vào mảng $allInformations
            while ($row = $result->fetch_assoc()) {
                $allInformations[] = $row;
            }
    
            // Trả về mảng chứa tất cả thông tin
            return $allInformations;
        } else {
            // Trả về null nếu có lỗi xảy ra trong quá trình truy vấn
            return null;
        }
    }

   


}