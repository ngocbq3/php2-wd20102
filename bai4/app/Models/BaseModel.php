<?php

namespace App\Models;

use PDO;

class BaseModel
{
    protected $conn = null; //Đối tượng kết nối CSDL
    protected $table = ""; //Tên bảng
    protected $primaryKey = "id"; //Khóa chính của bảng

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=utf8; port=" . PORT, USERNAME, PASSWORD);
        } catch (\PDOException $e) {
            echo "Lỗi kết nối dữ liệu: " . $e->getMessage();
        }
    }

    public static function all()
    {
        $model = new static;
        $sql = "SELECT * FROM {$model->table}";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
}
