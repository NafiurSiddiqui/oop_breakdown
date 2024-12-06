<?php

declare(strict_types=1);

//EASY
//one thing - protect the integrity of the encapsulation and NEVER directly modify the properties without getter/setter

abstract class Device
{

    private string $status = 'off';

    public function __construct(
        public string $name,
    ) {
        $this->name = $name;
    }

    public function turnOn()
    {
        echo "Locating power button.\n Pressing down the button. \n device is turning on...\n";
        $this->setDeviceStatus();
    }

    public function deviceStatus()
    {
        echo "$this->name is " . $this->getDeviceStatus() . "\n";
    }

    public function turnOff()
    {
        echo "locating power button.\n Pressing down the button \n Device is turning off... \n";
        $this->setDeviceStatus();
    }
    //GETTER
    public function getDeviceStatus(): string
    {
        return $this->status;
    }
    //SETTER
    public function setDeviceStatus(): void
    {

        $this->status === 'off' ? $this->status = 'on' : $this->status = 'off';
    }

    abstract function operate();
}

class Phone extends Device
{
    public function operate()
    {
        echo "phone is ringing\n";
    }
}


class Speaker extends Device
{
    public function operate()
    {
        echo "speaker is playing music.\n";
    }
}

$phone = new Phone('Android phone');
$speaker = new Speaker('Bluetooth speaker');

$phone->deviceStatus();
// $phone->turnOn();
// $phone->deviceStatus();
// $phone->operate();
// $phone->turnOff();
// $phone->deviceStatus();


// $speaker->deviceStatus();
// $speaker->turnOn();
// $speaker->deviceStatus();
// $speaker->operate();
// $speaker->turnOff();
// $speaker->deviceStatus();


//----------INTERMEDIATE

abstract class NotificationSystem
{

    public int $notification_count = 0;

    abstract function sendNotification(string $message): void;

    public function trackSentNotifications(): void
    {
        $this->notification_count += 1;
        echo "$this->notification_count notification" . $this->wordPluralizer() . " is sent. \n";
    }
    //DRY
    private function wordPluralizer(): string
    {
        return $this->notification_count > 1 ? "s" : '';
    }
}


class EmailNotificationSystem extends NotificationSystem
{
    public function sendNotification(string $message): void
    {
        echo "Email notification is sent to user with message: $message \n";
        $this->trackSentNotifications();
    }
}


class SMSNotificationSystem extends NotificationSystem
{
    public function sendNotification(string $message): void
    {
        echo "SMS notification is sent to user with message: $message \n";
        $this->trackSentNotifications();
    }
}


$email = new EmailNotificationSystem();
$sms = new SMSNotificationSystem();


// $email->sendNotification("You have got a new notification!\n");
// $email->notification_count;
// $email->sendNotification("An email to the user is being sent!\n");
// $email->notification_count;



// $sms->sendNotification(12345);//Fails due to type safety - awesome
// $sms->notification_count;
// $sms->sendNotification("Pin: 29427");
// $sms->notification_count;
// $sms->sendNotification("OTP: 43525");
// $sms->notification_count;


//----------- EXPERT


abstract class Transportation
{

    public function __construct(
        public int $capacity,
        public ?string $fuelType = 'none'
    ) {
        $this->capacity = $capacity;
        $this->fuelType = $fuelType;
    }
    abstract public function calculateTripTime(float $distance, float $speed): void;

    public function printDetails(): void
    {
        echo "Capacity: $this->capacity, Fuel Type: $this->fuelType \n";
    }

    public function formatTripTimeMessage(string $subclassName, mixed $formula): void
    {
        echo $subclassName . " trip time is: " . $formula . "\n";
    }
}



class Car extends Transportation
{
    public function calculateTripTime(float $distance, float $speed): void
    {
        echo $this->formatTripTimeMessage(__CLASS__, $distance / $speed);
    }
}

class Airplane extends Transportation
{
    public function calculateTripTime(float $distance, float $speed): void
    {
        echo $this->formatTripTimeMessage(__CLASS__, $distance / $speed);
    }
}

class Bicycle extends Transportation
{
    public function calculateTripTime(float $distance, float $speed): void
    {
        echo $this->formatTripTimeMessage(__CLASS__, $distance / $speed);
    }
}


$car = new Car(4, 'Patrol');
$car->printDetails();
$car->calculateTripTime(100, 50);

$airplane = new Airplane(200, 'Jet Fuel');
$airplane->printDetails();
$airplane->calculateTripTime(1000, 500);

$bicycle = new Bicycle(1);

$bicycle->printDetails();
$bicycle->calculateTripTime(10, 5);
