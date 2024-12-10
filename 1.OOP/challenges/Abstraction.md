Here are the challenges:

---

### **Easy Level**

Create an **abstract class** for a **Device**.  
Each device can:

- Turn on and off.
- Have a `batteryLevel` property that can be updated.

Define the following:

1. An abstract method `operate()` that represents the unique functionality of each device (e.g., calling for a phone or playing for a music player).
2. Two concrete methods `turnOn()` and `turnOff()` to change the device's state.

Create at least two subclasses (`Phone` and `MusicPlayer`) implementing `operate()`.

---

### **Intermediate Level**

Build an **abstract class** for a **NotificationSystem**.  
Each notification system should:

- Handle messages and send notifications.
- Track how many notifications have been sent.

Define:

1. An abstract method `sendNotification(string $message)` for sending notifications.
2. A concrete method `trackSentNotifications()` to increment and log the notification count.

Create at least two notification systems:

- `EmailNotificationSystem` (e.g., send email).
- `SMSNotificationSystem` (e.g., send text).

---

### **Expert Level**

Design an **abstract class** for a **Transportation** system.  
Each mode of transport should:

- Have a `capacity` and `fuelType` property.
- Calculate the time required for a trip given a distance and speed.

Define:

1. An abstract method `calculateTripTime(float $distance, float $speed): float`.
2. A concrete method `printDetails()` that prints the capacity and fuel type.

Create at least three subclasses:

- `Car` (handles passengers).
- `Airplane` (handles cargo).
- `Bicycle` (requires no fuel).
