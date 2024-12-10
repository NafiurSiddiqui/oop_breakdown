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
function printVehicleMovement(array $vehicles)
{
    try {
        foreach ($vehicles as $vehicle) {
            $vehicle->move();
        }
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}


//! Lets violate LSP in the first place

class AmphibousVehicle extends Vehicle
{
    public function move(): void
    {
        echo $this->getManufacturerModel() . " is moving in the outer space, water, land, air" . PHP_EOL;
        throw new \Exception("!!AmphibiousVehicle cannot switch modes correctly.!!");
    }
}

//first think about it, why does it actually violates the LSP and then compare with the explanation.
$ampy = new AmphibousVehicle('Xavier', 'warpsteer', 6);

//add ampy to the $vehicles array
$vehicles[] = $ampy;


printVehicleMovement($vehicles);
