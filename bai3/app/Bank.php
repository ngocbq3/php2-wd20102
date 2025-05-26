<?php

namespace App;

abstract class  Bank
{
    protected $acc;
    protected $numberAcc;
    protected $balance;

    public function __construct($acc, $numberAcc, $balance)
    {
        $this->acc = $acc;
        $this->numberAcc = $numberAcc;
        $this->balance = $balance;
    }

    public abstract function withDraw($money);
    public abstract function deposit($money);
    public abstract function transfer($person, $money);
}
