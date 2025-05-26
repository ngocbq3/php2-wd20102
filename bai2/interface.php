<?php


interface Animal
{
    public function sound();
    public function run();
    public function eat($food);
}

class Dog implements Animal
{
    public $name;
    public $age;
    public $color;

    public function __construct($name, $age, $color)
    {
        $this->name = $name;
        $this->age = $age;
        $this->color = $color;
    }

    public function sound()
    {
        echo "<br> $this->name đang kêu go..go.. <br>";
    }

    public function run()
    {
        echo "<br> $this->name đang chạy rất nhanh <br>";
    }
    public function eat($food)
    {
        echo "<br> $this->name đang ăn $food <br>";
    }
}

$dog = new Dog("Cậu vàng", 12, "Vàng");
$dog->sound();
$dog->run();
$dog->eat("Xương cục");
