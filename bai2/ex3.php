<?php

abstract class Animal
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

    public abstract function  sound();
}

class Dog extends Animal
{
    public function sound()
    {
        echo "<br> $this->name đang kêu go..go.. <br>";
    }
}
class Cat extends Animal
{
    public function sound()
    {
        echo "<br> $this->name đang kêu meo .. meo .. <br>";
    }
}

$dog = new Dog('Scupydoo', 12, 'Vàng');
$cat = new Cat("Tom", 20, 'Tam thể');

$dog->sound();
$cat->sound();

