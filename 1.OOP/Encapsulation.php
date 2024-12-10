<?php

class User
{

    public function __construct(
        public string $name,
        public string $email,
        private int $bankBalance = 0,
        protected string $password,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->bankBalance = $bankBalance;
    }
    //GETTERS
    public function getBankBalance(): int
    {
        return $this->bankBalance;
    }
    //SETTERS
    public function setBankBalance(int $bankBalance): void
    {
        $this->bankBalance = $bankBalance;
    }
}

$userA = new User('Jenny', 'jenny@xyz.com', 100000, 'secret');
echo $userA->name;
echo ' ';
echo $userA->email;
// $userA->bankbalance; //!Will throw error
// $userA->password; //!Will throw error 


//?can I change the public property again ?

$userA->name = "Hacked"; //YES. Since it is public, I can.
echo ' ';

//AFTER getter and setter method
echo "Previous balance: " . $userA->getBankBalance();
echo ' ';
echo $userA->setBankBalance(200000);
echo ' ';
echo "Updated balance: " . $userA->getBankBalance();
