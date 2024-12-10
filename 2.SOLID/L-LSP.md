# DRAFT

What i have understood from the theoritical point is, according to LSV -

- A subclass's behavior should be in sync with the parent classes behavior. Like a contract, not anything beyond the contract?
  - A subclass actually can have extended behaviors. What it should not do is to override or modify the behavior in a contradictory manner. Such as -
  - Parent `streetVehicle` has a method that shares the functionality of `numberOfWheels()`. If a `Boat` extends from `streetVehicle` and applies `numberOfWheels()` method, does not make sense.
- The subclass should not have any methods or behavior that violates the purpose of the parent class. Like, it does not make sense to extend a `Boat` from a parent `streetVehicles` class, because a boat can not ride on the streets (Let's keep it as a general point of view, not a multi-purpose vehicle).
