<?php
//what happens when we call parent constructor and when not

class Instrument
{

    public function __construct(
        public string $name,
        public int $price,
    ) {
        $this->name = $name;
        $this->price = $price;
    }


    public function playSound()
    {
        echo "Instrument plays some sort of sound";
    }
}

// $acousticGuitar = new Instrument('acoustic_guitar', '3000');

// $acousticGuitar->playSound('plucking sound');
// echo " $acousticGuitar->name"; //BAD EXAMPLE

class Guitar extends Instrument
{
    public function __construct(
        public string $name,
        public int $price,
        private string $type
    ) {
        // parent::__construct($name, 3000);
        //without parent constructor name is not defined.
        $this->type = $type;
    }

    public function playSound()
    {
        echo "$this->name playing plucking sound!\n ";
    }

    public function getType(): string
    {
        return $this->type;
    }
}

// $guitar = new Guitar('Local Acoustic Guitar', 3000, ' Acoustic');

// $guitar->playSound();
// echo "$guitar->name\n";
// echo "$guitar->price\n";
// echo $guitar->getType();


class Employee
{
    protected string $name;
    protected int $id;

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
}

class Manager extends Employee
{

    public function __construct(
        public string $name,
        protected int $id,
        public string $department
    ) {
        parent::__construct($name, $id); // Initialize common Employee properties.
        $this->department = $department;
    }

    public function getId(): string
    {
        return "id of $this->id\n";
    }
}
$manager = new Manager('John Doe', 123, 'Sales');
echo $manager->name . "\n";
// echo $manager->id . "\n";
// echo $manager->getId();
echo $manager->getId();
echo $manager->department . "\n"; // Accessing the department property of the Manager class.