<?php

namespace App\Models;

use PDO;

class BaseModel
{
    protected $conn = null; //Đối tượng kết nối CSDL
    protected $table = ""; //Tên bảng
    protected $primaryKey = "id"; //Khóa chính của bảng
    protected $sqlBuilder; //Câu lệnh SQL

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=utf8; port=" . PORT, USERNAME, PASSWORD);
        } catch (\PDOException $e) {
            echo "Lỗi kết nối dữ liệu: " . $e->getMessage();
        }
    }

    //Phương thức all để lấy ra tất cả các bản ghi trong 1 bảng
    public static function all()
    {
        $model = new static;
        $sql = "SELECT * FROM {$model->table}";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    /**
     * @method find: phương thức lấy 1 bản ghi theo khóa chính
     * @param $id: là khóa chính của bảng
     */
    public static function find($id)
    {
        $model = new static;
        $sql = "SELECT * FROM {$model->table} WHERE {$model->primaryKey} = :{$model->primaryKey}";

        $stmt = $model->conn->prepare($sql);
        $stmt->execute(["{$model->primaryKey}" => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        if ($result)
            return $result[0]; //Nếu có dữ liệu
        return null; //Nếu không có dữ liệu
    }

    /**
     * @method select: lựa chọn các cột cần lấy trong bảng
     */
    public static function select($columns = ['*'])
    {
        $model = new static;
        $model->sqlBuilder = "SELECT ";
        foreach ($columns as $column) {
            $model->sqlBuilder .= " {$column}, ";
        }
        //Xóa dấu , ở cuối lệnh SQL
        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ");

        $model->sqlBuilder .= " FROM {$model->table}";
        return $model;
    }
    /**
     * @method join: nối bảng
     */
    public function join($tableName, $refKey)
    {
        $this->sqlBuilder .= " JOIN {$tableName} 
                ON {$this->table}.{$this->primaryKey} = {$tableName}.{$refKey}";
        return $this;
    }
    /**
     * @method get: phương thức thực thi lệnh SQL select
     */
    public function get()
    {
        $stmt = $this->conn->prepare($this->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
}
