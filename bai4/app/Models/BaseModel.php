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
     * @method get: phương thức thực thi lệnh SQL select và lấy kết quả
     */
    public function get()
    {
        $stmt = $this->conn->prepare($this->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    /**
     * @method orderBy: phương thức sắp xếp
     * @param $name: tên cột muốn sắp xếp
     * @param $sort: sắp xếp
     */
    public function orderBy($name, $sort = 'ASC')
    {
        $this->sqlBuilder .= " ORDER BY $name $sort";
        return $this;
    }
    /**
     * @method limit: phương thức hạn chế số bản ghi cần lấy
     * @param $limit: số lượng bản ghi
     */
    public function limit($limit = 10)
    {
        $this->sqlBuilder .= " LIMIT $limit";
        return $this;
    }

    /**
     * @method where: điều kiện
     * @param $column: tên cột
     * @param $operater: toán tử so sánh
     * @param $value: giá trị
     */
    public function where($column, $operater, $value)
    {
        $this->sqlBuilder .= " WHERE $column $operater '$value'";
        return $this;
    }

    /**
     * @method andWhere: thêm điều kiện AND
     * @param $column: tên cột
     * @param $operater: toán tử so sánh
     * @param $value: giá trị
     */
    public function andWhere($column, $operater, $value)
    {
        $this->sqlBuilder .= " AND  $column $operater '$value'";
        return $this;
    }

    /**
     * @method orWhere: thêm điều kiện OR
     * @param $column: tên cột
     * @param $operater: toán tử so sánh
     * @param $value: giá trị
     */
    public function orWhere($column, $operater, $value)
    {
        $this->sqlBuilder .= " OR  $column $operater '$value'";
        return $this;
    }

    /**
     * @method create: thêm dữ liệu
     * @param @data: data là mảng dữ liệu gồm có key: columnName và value
     */
    public static function create($data)
    {
        $model = new static;
        $sql = "INSERT INTO $model->table(";
        $columnNames = ""; //Danh sách các cột
        $params = ""; //Danh sách các tham số

        foreach ($data as $key => $value) {
            $columnNames .= " `{$key}`, ";
            $params .= " :{$key}, ";
        }


        //Xóa dấu , ở cuối các chuỗi $columnNames và $params
        $columnNames = rtrim($columnNames, ', ');
        $params = rtrim($params, ', ');
        $sql .= $columnNames . ') VALUES (' . $params . ')';

        $stmt = $model->conn->prepare($sql);
        $stmt->execute($data);
        return $model->conn->lastInsertId(); //Lấy ra id mới thêm
    }

    /**
     * @method update: để  cập nhật dữ liệu
     * @param $id: khóa chính
     * @param $data: dữ liệu cập nhật
     */
    public static function update($id, $data)
    {
        $model = new static;
        $sql = "UPDATE $model->table SET ";
        foreach ($data as $key => $value) {
            $sql .= " `{$key}`=:{$key}, ";
        }
        //Xóa dấu , ở cuối chuỗi
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE {$model->primaryKey}=:{$model->primaryKey}";

        $stmt = $model->conn->prepare($sql);
        //Thêm $id vào mảng
        $data["$model->primaryKey"] = $id;
        $stmt->execute($data);
    }
}
