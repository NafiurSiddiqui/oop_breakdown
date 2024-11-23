<?php

class LibraryItem
{


    public function __construct(
        private string $title,
        private string $author,
        private int $publicationYear,
        private float $price
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPublicationYear(): int
    {
        return $this->publicationYear;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setDiscount(int $percentage): void
    {
        if ($percentage <= 0) {
            throw new Exception("Discount percentage must be greater than 0");
        }

        $discountedPrice = $this->price - ($this->price * $percentage / 100);

        if ($discountedPrice <= 0) {
            throw new Exception("Discounted price must be greater than 0");
        }

        $this->price = number_format($discountedPrice, 2, '.');
    }

    public function getSummary(): string
    {

        return <<<SUMMARY
        Title: $this->title
        Author: $this->author
        Publication Year: $this->publicationYear
        Price: $this->price\n
        SUMMARY;
    }
}


//create a Book, Magazine, EBook class with their own variations

class Book extends LibraryItem
{
    private int $pageCount;

    public function __construct(
        string $title,
        string $author,
        int $publicationYear,
        float $price,
        int $pageCount
    ) {
        parent::__construct(
            $title,
            $author,
            $publicationYear,
            $price
        );

        $this->pageCount = $pageCount;
    }

    public function getSummary(): string
    {
        return parent::getSummary() . "Page Count: $this->pageCount\n\n";
    }
}

$book = new Book('1984', 'George Orwell', 1949, 14.90, 350);

echo $book->getSummary();
$book->setDiscount(5);
echo "Discount on Book - " . $book->getPrice() . "\n";

class Magazine extends LibraryItem
{
    private int $issueNumber;

    public function __construct(
        string $title,
        int $publicationYear,
        float $price,
        int $issueNumber
    ) {
        parent::__construct(
            $title,
            'N/A',
            $publicationYear,
            $price
        );

        $this->issueNumber = $issueNumber;
    }

    public function getSummary(): string
    {
        return parent::getSummary() . "Issue: $this->issueNumber\n\n";
    }
}
//THERE IS NO AUTHOR FOR MAGAZINES
$magazine = new Magazine('Computer Magazine', 1995, 12.85, 30);

echo $magazine->getSummary();
$magazine->setDiscount(10);
echo "Discount on Magazine - " . $magazine->getPrice() . "\n";

class Ebook extends LibraryItem
{
    private int $fileSize;

    public function __construct(
        string $title,
        string $author,
        int $publicationYear,
        float $price,
        int $fileSize
    ) {
        parent::__construct(
            $title,
            $author,
            $publicationYear,
            $price
        );

        $this->fileSize = $fileSize;
    }

    public function getSummary(): string
    {
        return parent::getSummary() . "File Size: $this->fileSize MB\n\n";
    }
}

$ebook = new Ebook('Teach yourself OOP', 'Nafi R', 2024, 8.50, 512);
echo $ebook->getSummary();
$ebook->setDiscount(5);
echo "Discount on eBook - " . $ebook->getPrice() . "\n";
