<?php

namespace App;

class HKBank extends Bank
{
    public function withDraw($money)
    {
        if ($money > 0) {
            $this->balance += $money;
            echo "$this->acc vừa nạp thành công số tiền: $money <br>";
        } else {
            echo "Số tiền {$money} nạp vào không hợp lệ <br>";
        }
    }

    public function deposit($money)
    {
        if ($money > 0 && $money < $this->balance) {
            $this->balance -= $money;
            echo "$this->acc vừa rút thành công số tiền: $money <br>";
            echo "Số tiền trong tài khoản của bạn còn: $this->balance <br>";
        } else {
            echo "Số tiền {$money} cần rút không hợp lệ <br>";
        }
    }

    public function transfer($person, $money)
    {
        if ($money > 0 && $money < $this->balance) {
            $this->balance -= $money;
            $person->addMoneyForBalance($money);
            echo "Bạn đã chuyển số tiền {$money} đến tài khoản " . $person->getNumberAcc() . " thành công <br>";
            echo "Số tiền còn lại trong tài khoản của bạn là: {$this->balance}<br>";
        } else {
            echo "Số tiền cần truyển không hợp lệ <br>";
        }
    }
    public function getNumberAcc()
    {
        return $this->numberAcc;
    }

    public function getBalace()
    {
        return $this->balance;
    }
    public function addMoneyForBalance($money)
    {
        $this->balance += $money;
    }
}
