<?php

//ANALOGY # 1
//we have two sockets that supports a certain type of plugs

//A low-power socket that supports lightweight devices like laptop, phones,etc.
//A heavy-power socket. Supports heavy duty electornic appliances like the - refrigerator, washing machine, etc.

//!--- BAD CODE STARTS

// class LowPowerSocket
// {

//     private object $phone;
//     private object $laptop;

//     public function __construct()
//     {
//         $this->phone = new Phone('TiePhone');
//         $this->laptop = new Laptop('Bell');
//     }

//     public function charegePhone()
//     {
//         echo "Charging " . $this->phone->getName() . PHP_EOL;
//     }
//     public function charegeLaptop()
//     {
//         echo "Charging " . $this->laptop->getName() . PHP_EOL;
//     }
// }

// class Phone
// {
//     public function __construct(protected string $name)
//     {
//         $this->name = $name;
//     }

//     public function getName(): string
//     {
//         return $this->name;
//     }
// }
// class Laptop
// {
//     public function __construct(
//         protected string $name
//     ) {
//         $this->name = $name;
//     }
//     public function getName(): string
//     {
//         return $this->name;
//     }
// }


// $lpsocket = new LowPowerSocket();
// $lpsocket->charegeLaptop();
// $lpsocket->charegePhone();

//ANALYSIS
/**
 * Everything works fine, so what seems to be the problem?
 * In terms of design pattern this is horrendous. What happen when you need to charge a portable speaker, tablet, smartwatch and myriads others?
 * Think how large, messy, tedious it can become over time!
 */

//DIP violation
/**
 * 
 * TIGHTLY COUPLED -
 * 
 * Our high-level module depends on low-level modules like phone and laptop, which is tighly coupled. 
 * 
 * LACK OF ABSTRACTION
 * 
 * There is no abstraction, just concrete implementation like instantiating phone and laptop directly inside the LowPowerSocket class.
 * 
 * VIOLATION OF OCP
 * 
 * If we are to add more devices, we have to modify the base class which violates the OCP (Open-Close principal) from SOLID design pattern.
 * 
 * 
 * SCALIBILITY ISSUE
 * 
 * If new devices are introduced the base class will be bloated with other devices, again violating OCP each time.
 */


//!BAD CODE ENDS



//?GOOD CODE STARTS

//Lets look at our _5.DIP.md_ file. what needs to be done to respect the DIP?

/**
 * High-level modules (e.g., your business logic) should not depend on low-level modules (e.g., database access code)
 * 
 * Both should depend on abstractions (interfaces or abstract classes).
 * 
 * Abstractions should not depend on details.
 * 
 * Details (implementations) should depend on abstractions.
 */

//let's implement them

//FIRST, comment out the BAD CODE above.

//high level module should not depend on low level module. So, that lead us into removing those concrete implementations of instantiating other classes inside the constructor.

class LowPowerSocket
{



    public function __construct(protected ChargableDevice $device)
    {
        $this->device = $device;
    }

    public function chargeDevice(): void
    {

        echo "Supplying power to " . $this->device->getName() . PHP_EOL;
        $this->device->chargeDevice();
    }
}


interface ChargableDevice
{
    public function chargeDevice(): void;
    public function getName(): string;
}

//DRY- Note how we have the same format of message in both Phone and Laptop? Imagine we create more devices and in each devices we are copy pasting essentially the same format of message. Heance this SharedMessage trait is creaetd and used for reusability

trait SharedMessage
{

    public function message(string $name): string
    {
        return " $name is on charge now.\n";
    }
}


class Phone implements ChargableDevice
{

    use SharedMessage;

    public function __construct(protected string $name)
    {
        $this->name = $name;
    }

    public function chargeDevice(): void
    {
        echo $this->message($this->name);;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
class Laptop  implements ChargableDevice
{
    use SharedMessage;

    public function __construct(
        protected string $name
    ) {
        $this->name = $name;
    }

    public function chargeDevice(): void
    {
        echo $this->message($this->name);
    }
    public function getName(): string
    {
        return $this->name;
    }
}


$lpsocket = new LowPowerSocket(new Phone('TamTung'));
$lpsocket2 = new LowPowerSocket(new Laptop('Jasus'));

$lpsocket->chargeDevice();
$lpsocket2->chargeDevice();
