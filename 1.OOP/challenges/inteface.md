# Interface

This challenge teaches you the use of an `interface` when it is necessary.

**NOTE**

- This is an addition to the `Abstraction.php` challenge.
- Come to this challenge AFTER you are done with `Abstraction.php` challenge. You will know why and when do you exactly need an interface.

## Challenge

### Easy

Instead of moving the `turnOn`, `turnOff`, and `operate` methods to interfaces:

- Keep `Device` as an **abstract class** to handle core functionality.
- Add an **interface** for _optional_ features like `Upgradeable`. For example, a smart device might need a `performUpgrade()` method, but a basic device doesn't.

#### Modified Easy-Level Challenge:

- Introduce an **`Upgradeable` interface**:

  ```php
  interface Upgradeable {
      public function performUpgrade(): void;
  }
  ```

- Extend the `Device` hierarchy:
  - A `SmartPhone` implements `Upgradeable` because it supports upgrades.
  - A `BasicPhone` does not implement `Upgradeable` but still inherits `turnOn`, `turnOff`, and `operate` from `Device`.

This way, you **extend the codebase without breaking it**.

---

#### Intermediate Level

Instead of moving `sendNotification` and `trackSentNotifications` to interfaces:

- Keep `NotificationSystem` as the base **abstract class**.
- Use interfaces for adding new functionality without modifying the base class (SOLID).
- Problem: The application requires a new feature for `NotificationSystem`, some of the notification requires persisting in db.

#### Modified Intermediate-Level Challenge:

- Introduce an interface `persistable`:

  ```php
  interface Persistable {
      public function saveNotification(mixed $data): void;
  }
  ```

This allows new features to be layered onto the system **without altering its fundamental architecture**.

---

#### Expert Level

Instead of forcing every `Transportation` class to implement `FuelConsumable`:

- Use `FuelConsumable` as an optional interface for fuel-dependent transport types (e.g., cars, planes).
- Leave core functionality like `calculateTripTime` in the abstract class.

#### Modified Expert-Level Challenge:

- Keep `Transportation` as the base **abstract class**.
- Introduce:

  - `FuelConsumable` for fuel consumption.
  - `PassengerManagement` for vehicles like buses or planes that need to manage passengers.

  ```php
  interface FuelConsumable {
      public function calculateFuelConsumption(float $distance): float;
  }

  interface PassengerManagement {
      public function loadPassengers(int $count): void;
      public function unloadPassengers(): void;
  }
  ```

- Extend the system with new transport types:
  - A `Bus` that implements both `PassengerManagement` and `FuelConsumable`.
  - A `Bicycle` that implements neither, showcasing how interfaces can be **selectively applied** to extend behavior.

---

#### **Why This Approach?**

1. **Backward Compatibility:**

   - Interfaces are introduced without altering the existing abstract class, so the core system remains intact.

2. **Selective Application:**

   - Interfaces allow you to add features to relevant classes without forcing unrelated classes to implement methods they don't need.

3. **Scalability:**
   - The architecture is now open to **new features** or classes (e.g., electric cars, self-driving vehicles) that don't require sweeping changes.

---

### **Takeaway**

Instead of refactoring core functionality into interfaces, think of interfaces as tools for **optional behaviors** or **extension points**. They let you scale and evolve your codebase while maintaining cohesion and avoiding overengineering.

---

### **Why Avoid Overusing Interfaces for Core Functionality?**

1. **Cohesion of Core Features:**

   - If all devices inherently need to turn on/off and perform specific operations, these methods logically belong in an **abstract class**. Abstract classes are best suited to define shared functionality and reuse code.

2. **Interfaces Shine for Adding Capabilities:**
   - Interfaces are excellent for **extending capabilities** or adding optional behaviors to classes that might not share a strict hierarchy. This avoids forcing unrelated classes into a rigid structure.

---
