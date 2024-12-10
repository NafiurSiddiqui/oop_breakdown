# Challenge: Build a Library System

Imagine you're building a Library System where you have different types of items (books, magazines, and e-books). Each type of item will share some common properties, but also have its own specific characteristics and behaviors.

Also actually teaches you polymorphism in this challenge.

## Requirements

### Base Class: LibraryItem

- **Common properties:**
  - `title`
  - `author`
  - `publicationYear`
  - `price`
- **Common method:**
  - `getSummary()`:
    - Should return a description of the item (e.g., `Title: <title>, Author: <author>, Year: <publicationYear>`).
- **Encapsulation:**
  - Use private or protected properties.
  - Provide getter and setter methods where necessary.

### Child Classes

1. **Book**

   - **Inherits from:** `LibraryItem`
   - **Additional property:**
     - `pageCount`
   - **Method `getSummary()`:**
     - Overridden to include `pageCount` (e.g., `Book: <title>, <author>, Pages: <pageCount>`).

2. **Magazine**

   - **Inherits from:** `LibraryItem`
   - **Additional property:**
     - `issueNumber`
   - **Method `getSummary()`:**
     - Overridden to include `issueNumber` (e.g., `Magazine: <title>, Issue: <issueNumber>`).

3. **EBook**
   - **Inherits from:** `LibraryItem`
   - **Additional property:**
     - `fileSize`
   - **Method `getSummary()`:**
     - Overridden to include `fileSize` (e.g., `EBook: <title>, Size: <fileSize>`).

### Methods to Implement in the Base Class

1. **Getters for:**

   - `getTitle()`
   - `getAuthor()`
   - `getPublicationYear()`
   - `getPrice()`
   - All should be private or protected, with getters to access them.

2. **Apply Discount:**
   - `applyDiscount($percentage)`:
     - Updates the `price` of the item.

---

## Use Case

1. Create instances of `Book`, `Magazine`, and `EBook`.
2. Call `getSummary()` on each to verify that the overridden behavior works.
3. Apply a discount to each item and display the updated price.

---

## Guidelines

- **Encapsulation:**
  - Keep properties like `price`, `title`, and `author` private or protected.
  - Only expose them via getter and setter methods.
- **Inheritance:**
  - Ensure that the child classes inherit common properties and methods from the `LibraryItem` class.
- **Polymorphism:**
  - Ensure each subclass has its own implementation of `getSummary()`.

---

## Bonus Challenge

### Library Class

Create a `Library` class that can hold a collection of `LibraryItem` objects (`Books`, `Magazines`, `EBooks`).

#### The Library class should be able to:

1. **Add items.**
2. **List all items in the library.**
3. **Calculate the total value of all items (with applied discounts).**
4. **Print summaries of all items.**

---

## How to Approach This Challenge

1. Define the base class `LibraryItem`.
2. Implement private properties for `title`, `author`, `publicationYear`, and `price` in `LibraryItem`.
3. Add getter methods for these properties.
4. Create child classes (`Book`, `Magazine`, `EBook`) and ensure they override the `getSummary()` method.
5. Add discount functionality by creating the `applyDiscount()` method in the `LibraryItem` class.
6. Build the `Library` class to manage collections of `LibraryItem` objects.
7. Test the entire system by creating instances of the different classes and calling their methods.

---

## Sample Output

```plaintext
Book: The Great Gatsby, Author: F. Scott Fitzgerald, Pages: 180
Magazine: Tech Trends, Issue: 25
EBook: Digital Transformation, Size: 5MB

Applying 20% discount to all items...
The Great Gatsby - New Price: $16
Tech Trends - New Price: $8
Digital Transformation - New Price: $4

Library Summary:
Total Value: $28
```
