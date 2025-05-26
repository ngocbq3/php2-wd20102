<?php

class Animal
{
    public $name;
    protected $age;
    private $color;

    //Phương thức khởi tạo
    public function __construct($name, $age, $color)
    {
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
    }
    //Hiển thị thông tin con vật
    public function info()
    {
        echo "Tên con vật $this->name <br>";
        echo "Tuổi con vật: $this->age <br>";
        echo "Màu sắc: $this->color <br>";
    }
}

//Tính kế thừa
class Cat extends Animal
{
    public function setAge($age)
    {
        $this->age = $age;
    }
}

$animal = new Animal('Cậu vàng', 10, 'Vàng');
// $animal->name = "Cậu vàng";
// $animal->age = 10;
// $animal->color = "Vàng";

//Gọi phương thức info
$animal->info();

//Khai báo đối tượng cho lớp Cat
$tom = new Cat('Tom', 100, 'Tam thể');
$tom->setAge(50);
$tom->info();

/**
 * Hãy tạo 1 lớp con người (People) gồm các thuộc tính
 * ten, tuoi, diachi: trong đó tuoi protected, diachi private
 * và tạo lớp con là nhanvien (Employee) của lớp (People)
 * bao gồm các phương thức: thông tin nhân viên
 * Viết thêm các phương thức để truy cập tới các thuộc tính
 */
