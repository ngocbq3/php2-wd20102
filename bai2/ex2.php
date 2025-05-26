<?php

class Animal
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
        echo "<br> $this->name đang kêu ...<br>";
    }
}

class Dog extends Animal
{
    public function sound()
    {
        echo "<br> $this->name đang kêu go..go.. <br>";
    }
}

$animal = new Animal("Tom ket", 20, 'Xám');
$dog = new Dog("Cậu Vàng", 15, "Vàng");

$animal->sound();
$dog->sound();
