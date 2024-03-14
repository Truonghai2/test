<?php
include('config.php');

class db extends mysqli {
    // single instance of self shared among all instances
    private static $instance = null;

    // db connection config vars
    private $user = DBUSER;
    private $pass = DBPWD;
    private $dbName = DBNAME;
    private $dbHost = DBHOST;

    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __clone() {
        trigger_error('Bản sao không được phép.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Việc khử lưu huỳnh không được phép.', E_USER_ERROR);
    }

    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        parent::set_charset('utf8mb4'); // Sửa đổi bộ ký tự thành utf8mb4 để hỗ trợ Unicode đầy đủ
    }

    public function dbquery($query) {
        return $this->query($query); // Trả về kết quả trực tiếp từ phương thức query
    }

    public function get_result($query) {
        $result = $this->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }
}
?>
