<?php


//Задание 1
class Person {
    public string $name = "";
    public int $age = 0;
}

$person_1 = new Person();
echo $person_1->name = "ИВАН" . "\n";
echo $person_1->age = 20 . "\n";;
echo "\n";;

$person_2 = new Person();
echo $person_2 ->name = "Василий" . "\n";;
echo $person_2->age = 23 . "\n";
echo "\n";
echo "\n";


//Задание 2
class Product {
    public string $title = "";
    protected int $stock = 0;
    private float $price = 0.0;
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
}
$product = new Product();
$product->setPrice(55.99);
echo $product->getPrice();
echo "\n";
echo "\n";


//Задание 3
class Greeter {
    private string $greeting = "";
    public function __construct(string $greeting)
    {
        $this->greeting = $greeting;
    }
    public function greet(string $name): string
    {
        return "{$this->greeting},{name}!";

    }
}
echo "\n";
echo "\n";

//Задание 4
class Book{
    public function __construct(
        string $title,
        string $author,
        int $year
    ){}
    public function getInfo(): string
    {
        return "«{$this->title}» ({$this->author}, {$this->year})";
    }
}
echo "\n";
echo "\n";

//Задание 5
class BankAccount
{
    private float $balance = 0.0;

    public function deposit(float $amount): void
    {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function withdraw(float $amount): bool
    {
        if ($amount > 0 && $this->balance >= $amount)
        {
            $this->balance -= $amount;
            return true;
        }

        return false;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
echo "\n";
echo "\n";

//Задание 6
class ShopProduct {

    public function __construct(
        private string $title,
        private string $producer,
        private float $price
    ) {}

    public function getSummaryLine(): string {
        return "{$this->title} ({$this->producer}) — {$this->price} ₽";
    }
}
echo "\n";
echo "\n";

//Задание 7
class User
{
    public function __construct(
        private string $name,
        private string $email
    ) {
        $this->createdAt = new \DateTimeImmutable();
    }

    private \DateTimeImmutable $createdAt;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getInfo(): string
    {
        return "{$this->name} ({$this->email}), зарегистрирован: {$this->createdAt->format('Y-m-d')}";
    }
}
echo "\n";
echo "\n";
