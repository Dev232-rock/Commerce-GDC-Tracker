<?php

class BankAccount {

    // private class and customer cannot thesei touch directly
    private $balance = 0;

    public function __construct($initialBalance) {
        $this->balance = $initialBalance;
    }

    // public class to add money
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            echo "Deposited: $amount<br>";
        }
    }

    // public and its the safe way to remove money
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            echo "Withdrawn: $amount<br>";
        } else {
            echo "Insufficient balance.<br>";
        }
    }

    // protected and used by child classes (bank systems)
    protected function calculateInterest() {
        return $this->balance * 0.05;
    }

    // public and view balance safely
    public function getBalance() {
        return $this->balance;
    }
}

