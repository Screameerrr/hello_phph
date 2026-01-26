<?php

//Задание 1
class Product
{
    protected string $title;
    protected float $price;

    public function __construct(string $title, float $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
class Book extends Product
{
    private string $author;

    public function __construct(string $title, float $price, string $author)
    {
        parent::__construct($title, $price);
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
echo "\n";
echo "\n";

//Задание 2
abstract class Lesson {
    abstract public function cost(): int;
    abstract public function chargeType(): string;
}

class Lecture extends Lesson {
    public function cost(): int { return 30; }
    public function chargeType(): string { return "Фиксированная ставка"; }
}
class Seminar extends Lesson {
    public function cost(): int { return 15; }
    public function chargeType(): string { return "Нефиксированная ставка";}
}
echo "\n";
echo "\n";

//Задание 3
interface Bookable {
    public function book(): void;
}

interface Chargeable {
    public function calculateFee(): float;
}
class Workshop implements Bookable, Chargeable {
    public function book(): void { /* ... */ }
    public function calculateFee(): float { return 1500.0; }
}
echo "\n";
echo "\n";

//Задание 4
function processBooking(Bookable $item): void {
    $item->book(); // работаем с любым объектом, реализующим Bookable
}
echo "\n";
echo "\n";

//Задание 5
trait PriceUtilities {
    public function calculateTax(float $price): float {
        return $price * 0.2;
    }
}

class ShopProduct {
    use PriceUtilities;

    public function __construct(private string $title, private float $price) {}

    public function getPriceWithTax(): float {
        return $this->price + $this->calculateTax($this->price);
    }
}
echo "\n";
echo "\n";

//Задание 6
trait IdentityTrait {
    public function generateId(): string {
        return uniqid();
    }
}

class ShopProduct {
    use PriceUtilities, IdentityTrait;
}
echo "\n";
echo "\n";

//Задание 7
trait Printer
{
    public function output(): void
    {
        echo "Printer output\n";
    }
}

trait Logger
{
    public function output(): void
    {
        echo "Logger output\n";
    }
}

class Report
{
    use Logger, Printer {
        Logger::output insteadof Printer;
        Printer::output as print;
    }
}
echo "\n";
echo "\n";

//Задание 8
trait Describable
{
    public function describe(): string
    {
        // Трейт обращается к свойству хост-класса ($this->name)
        return "Объект: {$this->name}";
    }
}

class Item
{
    use Describable;

    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
echo "\n";
echo "\n";

//Задание 9

trait Validatable
{
    abstract public function getRules(): array;
    public function validate(): bool
    {
        return true;
    }
}

class UserForm
{
    use Validatable;
    public function getRules(): array
    {
        return [
            'email' => 'required',
        ];
    }
}
echo "\n";
echo "\n";

//Задание 10

interface HasMedia
{
    public function getMediaLength(): int;
}

trait TaxCalculation
{
    public function getTax(): float
    {
        // 20% от цены
        return $this->price * 0.2;
    }
}

class BookProduct implements HasMedia
{
    use TaxCalculation;

    private string $title;
    private float $price;

    public function __construct(string $title, float $price)
    {
        $this->title = $title;
        $this->price = $price;
    }

    public function getMediaLength(): int
    {
        return 300;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class CDProduct implements HasMedia
{
    use TaxCalculation;
    private string $title;
    private float $price;
    public function __construct(string $title, float $price)
    {
        $this->title = $title;
        $this->price = $price;
    }
    public function getMediaLength(): int
    {
        return 74;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
}
echo "\n";
echo "\n";

//Задание 11

abstract class Service
{
    abstract public function getDuration(): int;
    abstract public function getDescription(): string;
}
interface Schedulable
{
    public function schedule(): string;
}
trait Logger
{
    public function log(string $msg): void
    {
        echo "[LOG] {$msg}" . PHP_EOL;
    }
}
class Consulting extends Service implements Schedulable
{
    use Logger;
    public function __construct(
        private string $topic,
        private int $duration
    ) {}
    public function getDuration(): int
    {
        return $this->duration;
    }
    public function getDescription(): string
    {
        return "Консалтинг по теме: {$this->topic}";
    }
    public function schedule(): string
    {
        return "Consulting scheduled: {$this->topic} ({$this->duration} мин)";
    }
}
class Training extends Service implements Schedulable
{
    use Logger;
    public function __construct(
        private string $program,
        private int $duration
    ) {}
    public function getDuration(): int
    {
        return $this->duration;
    }
    public function getDescription(): string
    {
        return "Тренинг по программе: {$this->program}";
    }
    public function schedule(): string
    {
        return "Training scheduled: {$this->program} ({$this->duration} мин)";
    }
}

$consulting = new Consulting("Архитектура API", 60);
$training   = new Training("PHP 8 OOP", 120);

echo $consulting->getDescription() . PHP_EOL;
echo $consulting->schedule() . PHP_EOL;
$consulting->log("Создан объект Consulting");

echo $training->getDescription() . PHP_EOL;
echo $training->schedule() . PHP_EOL;
$training->log("Создан объект Training");
echo "\n";
echo "\n";