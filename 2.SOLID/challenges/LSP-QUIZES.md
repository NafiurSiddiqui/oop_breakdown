Here are some quiz questions with code snippets to test students' ability to detect Liskov Substitution Principle (LSP) violations. Each question includes a scenario where they must decide if LSP is being adhered to or violated.

---

### **Quiz 1: Overriding Methods**

```php
class Bird {
    public function fly(): string {
        return "I can fly!";
    }
}

class Penguin extends Bird {
    public function fly(): string {
        throw new \Exception("Penguins can't fly!");
    }
}

function testFly(Bird $bird) {
    echo $bird->fly();
}

$eagle = new Bird();
$penguin = new Penguin();

testFly($eagle); // Works fine
testFly($penguin); // ???
```

**Question:** Does the above code adhere to LSP? Why or why not?

- A) Yes, because Penguins are a type of Bird.
- B) No, because the `Penguin` class violates the `fly()` behavior promised by the `Bird` class.
- C) Yes, because throwing an exception is a valid way to handle cases where flying isn’t possible.
- D) No, because Penguins shouldn’t inherit from `Bird`.

---

### **Quiz 2: Changing Method Behavior**

```php
class Employee {
    public function calculateBonus(int $salary): int {
        return $salary * 0.1;
    }
}

class Manager extends Employee {
    public function calculateBonus(int $salary): int {
        return $salary * 0.2;
    }
}

function displayBonus(Employee $employee, int $salary) {
    echo "Bonus: " . $employee->calculateBonus($salary);
}

$employee = new Employee();
$manager = new Manager();

displayBonus($employee, 5000); // Bonus: 500
displayBonus($manager, 5000); // Bonus: ???
```

**Question:** Is the `Manager` class violating LSP?

- A) Yes, because the calculation logic differs from the parent class.
- B) No, because the `Manager` class still respects the behavior of `Employee`.
- C) Yes, because the bonus rate is unexpectedly different for `Manager`.
- D) No, because child classes are allowed to have custom logic.

---

### **Quiz 3: Method Precondition**

```php
class Vehicle {
    public function refuel(int $amount): string {
        return "Refueled with $amount liters.";
    }
}

class ElectricCar extends Vehicle {
    public function refuel(int $amount): string {
        if ($amount > 0) {
            throw new \Exception("Electric cars don't need fuel!");
        }
        return "Charged the battery.";
    }
}

function testRefuel(Vehicle $vehicle, int $amount) {
    echo $vehicle->refuel($amount);
}

$car = new Vehicle();
$electricCar = new ElectricCar();

testRefuel($car, 50);         // Refueled with 50 liters
testRefuel($electricCar, 50); // ???
```

**Question:** Does the `ElectricCar` class adhere to LSP?

- A) Yes, because electric cars don’t need fuel, and the exception explains this behavior.
- B) No, because it changes the behavior of `refuel`, which violates the parent class's contract.
- C) Yes, because `refuel` can handle multiple types of vehicles differently.
- D) No, because electric cars should not inherit from `Vehicle`.

---

### **Quiz 4: Adding New Preconditions**

```php
class PaymentProcessor {
    public function processPayment(float $amount): string {
        return "Processed payment of $amount.";
    }
}

class SecurePaymentProcessor extends PaymentProcessor {
    public function processPayment(float $amount): string {
        if ($amount <= 0) {
            throw new \Exception("Amount must be greater than zero!");
        }
        return parent::processPayment($amount);
    }
}

function makePayment(PaymentProcessor $processor, float $amount) {
    echo $processor->processPayment($amount);
}

$processor = new PaymentProcessor();
$secureProcessor = new SecurePaymentProcessor();

makePayment($processor, 100);         // Works
makePayment($secureProcessor, -50);  // ???
```

**Question:** Is the `SecurePaymentProcessor` violating LSP?

- A) Yes, because it introduces new preconditions that the base class does not have.
- B) No, because it ensures safer payment processing.
- C) Yes, because negative payments should not throw exceptions.
- D) No, because child classes can add validation logic.

---

### **Quiz 5: Unexpected Side Effects**

```php
class Animal {
    public function eat(): string {
        return "Eating food.";
    }
}

class Dog extends Animal {
    public function eat(): string {
        echo "Running before eating... ";
        return parent::eat();
    }
}

function feedAnimal(Animal $animal) {
    echo $animal->eat();
}

$cat = new Animal();
$dog = new Dog();

feedAnimal($cat); // Eating food.
feedAnimal($dog); // ???
```

**Question:** Does the `Dog` class violate LSP?

- A) Yes, because it adds unexpected side effects to the `eat()` method.
- B) No, because dogs can run before eating.
- C) Yes, because `Dog` breaks the expected behavior of `Animal`.
- D) No, because it still calls the parent `eat()` method.

---

### **Answers and Explanations**

1. **Quiz 1**: **B**  
   Penguins can’t fly, so throwing an exception breaks the promise of the `fly` method. A better approach would be to avoid inheriting from `Bird` and create a separate `NonFlyingBird` class.

2. **Quiz 2**: **B**  
   The `Manager` class doesn’t violate LSP because it still calculates a bonus, which adheres to the parent class’s contract.

3. **Quiz 3**: **B**  
   The `ElectricCar` class violates LSP because it changes the expected behavior of `refuel`, which should be consistent across all `Vehicle` subclasses.

4. **Quiz 4**: **A**  
   Adding a precondition (e.g., `amount > 0`) in `SecurePaymentProcessor` violates LSP because it introduces new constraints that are not in the parent class.

5. **Quiz 5**: **A**  
   The `Dog` class violates LSP because it adds an unexpected side effect (running) to the `eat()` method, which contradicts the expected behavior of `Animal`.

---

These quizzes should help students identify subtle violations of LSP and understand why they occur!
