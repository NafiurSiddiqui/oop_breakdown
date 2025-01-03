<?php

//We are vehicle rental company offering transportation services. We have vehicles for land, water, air, space

//lets think what are the most common noun and verb in all of them?
// They are all vehicle as in noun.
// They all move for sure.
// they all carry passenger/s whether it is human, animal, robots.
// rests you can go fancy but lets keep it simple for the sake of understanding the LSP.


//Lets create a base class with the noun and verbs we have figured for our business

class Vehicle
{
    public function __construct(
        protected string $manufacturer,
        protected string $model,
        protected int $passengers,
    ) {
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->passengers = $passengers;
    }
    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving" . PHP_EOL;
    }

    public function passengerCapacity()
    {
        echo "This vehicle has a passenger capacity of " . $this->getPassengerCapacity() . PHP_EOL;
    }

    public function getManufacturerModel()
    {
        return "$this->manufacturer $this->model";
    }

    public function getPassengerCapacity()
    {
        return $this->passengers;
    }
}

class LandVehicles extends Vehicle
{
    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving on land" . PHP_EOL;
    }
}
class WaterVehicles extends Vehicle
{
    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving over the water" . PHP_EOL;
    }
}
class AirVehicles extends Vehicle
{
    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving in the air" . PHP_EOL;
    }
}
class SpaceVehicles extends Vehicle
{
    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving in the outer space" . PHP_EOL;
    }
}

$gtr = new LandVehicles('Nissan', 'GTR-35', 4);
$jet = new AirVehicles('McDonnell Douglas', 'F/A-18 Hornet', 2);
$speedBoat = new WaterVehicles('Gold Fish', '46 Bullet', 8);
$spaceship = new SpaceVehicles('NASA', 'Apollo 11', 3);

$vehicles = [$gtr, $jet, $speedBoat, $spaceship];

//---TOOL
function moveVehicle(Vehicle $vehicle): void
{
    $vehicle->move();
}

function testAllVehicleMoves(array $vehicles)
{
    try {
        foreach ($vehicles as $vehicle) {
            moveVehicle($vehicle);
        }
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}


//! Lets violate LSP in the first place - Violdate code starts
//If your IDE shouts, comment out the AmphibousVehicle class at the bottom, which is used for SOLUTION.

// class AmphibousVehicle extends Vehicle
// {
//     public function move(): void
//     {
//         echo $this->getManufacturerModel() . " is moving in the outer space,air, over the water, on the land" . PHP_EOL;
//         throw new \Exception("!!AmphibiousVehicle cannot switch modes correctly.!!");
//     }
// }

//first think about it, why does it actually violates the LSP and then compare with the explanation.
// $amph1 = new AmphibousVehicle('Xavier', 'warpsteer', 6);

//add ampy to the $vehicles array
// $vehicles[] = $amph1;

//! Violated code ends


//---------- ISSUE: Explained ----------

/**
 - The issue is with the amphibousVehicle. According to the LSP, you should be able to swap the parent class with the child class, and the program should still work as expected. 
 - SO, in our scenario, we wrote a program that moves all the vehicle. In the program, move vehicle, according to the LSP we should be able to substitute the `Vehicle` parent arugment with any of the subclass of type Vehicle without breaking the code. Each of the subclass adhered to the LSP and resepcted parents behavior and ran absolutely fine without breaking the program EXCEPT for Amphibous.
 - We are thrwoing an error, or it could be any other code that would alter and contradict the nature of the parent class.But here is the thing, if you notice closely, there is another thing the way I wrote the Amphibous, violates the LSP.
 - Hence, we are violating the LSP and introducing a bug in our program that would take quite a bit of time or days in a large application.
 - So, esentially there are two bugs here. Take your time and think about it for a moment. Other than the throwing exception, what is potentially breaking the program from the amph->move() method? Don't take more than 30 mins (max)
 - Don't worry if you did not find it. Let's break it down.
 */


//? ----------- What is the issue, how do we fix it?

/**
 * The issue lies in two -
 * 1. We are adding additional things to the `move()` method that actually violates the parents intended move method. It could be anything else as well, for instance, writing a code that stops the vehicle inside the move() method. Which does not make sense. 
 * 2. Note that I am writing that the '  " is moving in the outer space,air, over the water, on the land". This, if you think about it, all happening at once. Lets visualize an amph vehicle, when you accelerate, it moves but break because it keeps switchng between, water, air, land, space mode.
 */


//?------- FIX: LSP code start

//COMMENT OUT THE VIOLATED CODE FIRST and proceed down here

//very first thing we will take out the error
//second, we will introduce an additional method of switching the Mode before move method is called as a mandatory.

//lets rewrite the Amph class again.Comment out the first one.

class AmphibousVehicle extends Vehicle
{
    private array $modes = [
        'land',
        'water',
        'air',
        'outer space'
    ];
    private int $modeCounter = 0;
    // private string $mode = $modes[0]; //Throws error because you can not init a class property outside of the regular types like bool, int, string. Array won't work.

    private string $mode = 'land';


    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving " . $this->moveMessageFormatter() . PHP_EOL;
        //took out the error we introduced
    }

    public function switchMode(): void
    {
        $this->modeCounter = ($this->modeCounter + 1) % count($this->modes);
        $this->mode = $this->modes[$this->modeCounter];
        echo  "Amphibous switched to $this->mode";
    }
    //GETTER (Encapsulation)
    public function getMode(): void
    {

        echo $this->mode;
    }
    //DRY code
    public function moveMessageFormatter(): string
    {
        return match ($this->mode) {
            'land' => 'on the land',
            'water' => 'over the water',
            'air' => 'in the air',
            'outer space' => 'in the outer space',
            'default' => 'on the land'
        };
    }
}


$amph2 = new AmphibousVehicle('Xavier', 'warpsteer2', 6);

// $amph2->getMode();
echo "\n";
// $amph2->switchMode();
// $amph2->move();

//add $amph2 to the $vehicles array
$vehicles[] = $amph2;
//Now if we call our program to move all vehicles and remove apmh1 from the $vehicles array our program should run adhering the LSP

testAllVehicleMoves($vehicles);
echo "Amphibous Switching Mode \n";
//Lets switch mode for amph2
$amph2->switchMode();
echo "\n";
testAllVehicleMoves($vehicles);


//conclusion - now read the L-LSP.readme, and you will understand the theoritical aspect better.
//NOW head to the L-LSP-QUIZES.md to test your understanding and you should be good to move on to the next level.