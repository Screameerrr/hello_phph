<?php

// Задание 1
function isPrime(int $n): bool
{
    if ($n <= 1) {
        return false;
    }

    if ($n === 2) {
        return true;
    }

    if ($n % 2 === 0) {
        return false;
    }

    for ($i = 3; $i * $i <= $n; $i += 2) {
        if ($n % $i === 0) {
            return false;
        }
    }

    return true;
}

// Задание 2
function fibonacci(int $n): int
{
    if ($n < 0) {
        throw new InvalidArgumentException('n должен быть >= 0');
    }

    if ($n === 0) {
        return 0;
    }

    if ($n === 1) {
        return 1;
    }

    return fibonacci($n - 1) + fibonacci($n - 2);
}

// Задание №
function formatPhone(string $phone): string
{
    if (strlen($phone) !== 11) {
        throw new InvalidArgumentException('Номер должен содержать 11 цифр');
    }

    if (!ctype_digit($phone)) {
        throw new InvalidArgumentException('Номер должен состоять только из цифр');
    }

    if ($phone[0] !== '8' && $phone[0] !== '7') {
        throw new InvalidArgumentException('Номер должен начинаться с 8 или 7');
    }

    $code  = substr($phone, 1, 3);
    $part1 = substr($phone, 4, 3);
    $part2 = substr($phone, 7, 2);
    $part3 = substr($phone, 9, 2);

    return "+7 ({$code}) {$part1}-{$part2}-{$part3}";
}

// Задание 4
$numbers = [1,2,3,4,5,6,7,8,9,10];

$evenNumbers = array_filter($numbers, function (int $n): bool {
    return $n % 2 === 0;
});

// Задание 5
function memoizedFactorial(int $n): int
{
    if ($n < 0) {
        throw new InvalidArgumentException('n должен быть >= 0');
    }

    static $cache = [
        0 => 1,
        1 => 1
    ];

    if (isset($cache[$n])) {
        return $cache[$n];
    }

    $cache[$n] = $n * memoizedFactorial($n - 1);
    return $cache[$n];
}

// Задание 6
function createUser(
    string $name,
    string $email,
    int $age,
    bool $isActive = true
): array {
    return [
        'name' => $name,
        'email' => $email,
        'age' => $age,
        'isActive' => $isActive
    ];
}

$user = createUser(
    isActive: false,
    name: 'Иван',
    email: 'ivan@example.com',
    age: 25
);

// Задание 7
function makeCounter(): callable
{
    $count = 0;

    return function () use (&$count): int {
        return ++$count;
    };
}
