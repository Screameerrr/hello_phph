<?php


/**
 * Определяет, является ли число простым.
 *
 * Простое число — это число больше 1, которое делится только на 1 и само на себя.
 */
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

/**
 * Возвращает n-е число последовательности Фибоначчи (рекурсивно).
 *
 * fibonacci(0) = 0
 * fibonacci(1) = 1
 *
 */
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

/**
 * Форматирует телефон из вида "89123456789" в "+7 (912) 345-67-89".
 *
 * Требования:
 * - строка должна быть длиной 11
 * - должна содержать только цифры
 * - должна начинаться с 8 или 7
 * - используются только встроенные функции работы со строками
 */
function formatPhone(string $phone): string
{
    if (strlen($phone) !== 11) {
        throw new InvalidArgumentException('Номер должен содержать ровно 11 цифр');
    }

    if (!ctype_digit($phone)) {
        throw new InvalidArgumentException('Номер должен состоять только из цифр');
    }

    $first = $phone[0];
    if ($first !== '8' && $first !== '7') {
        throw new InvalidArgumentException('Номер должен начинаться с 8 или 7');
    }

    $code = substr($phone, 1, 3);
    $part1 = substr($phone, 4, 3);
    $part2 = substr($phone, 7, 2);
    $part3 = substr($phone, 9, 2);

    return "+7 ({$code}) {$part1}-{$part2}-{$part3}";
}

/**
 * Возвращает массив чётных чисел, отфильтрованных из входного массива.
 *
 * Использует array_filter() и анонимную функцию. Ключи переиндексируются.
 */
function filterEvenNumbers(array $numbers): array
{
    $filtered = array_filter(
        $numbers,
        function (int $x): bool {
            return $x % 2 === 0;
        }
    );

    return array_values($filtered);
}

/**
 * Вычисляет факториал числа с кэшированием результатов через static переменную.
 *
 * При повторном вызове с тем же n возвращает значение из кэша.
 */
function memoizedFactorial(int $n): int
{
    if ($n < 0) {
        throw new InvalidArgumentException('n должен быть >= 0');
    }

    /**
     * @var array<int,int> $cache
     */
    static $cache = [
        0 => 1,
        1 => 1,
    ];

    if (isset($cache[$n])) {
        return $cache[$n];
    }

    $cache[$n] = $n * memoizedFactorial($n - 1);

    return $cache[$n];
}

/**
 * Создаёт структуру пользователя.
 *
 * Демонстрация именованных аргументов: можно передавать параметры в любом порядке.
 */
function createUser(string $name, string $email, int $age, bool $isActive = true): array
{
    return [
        'name' => $name,
        'email' => $email,
        'age' => $age,
        'isActive' => $isActive,
    ];
}

/**
 * Создаёт генератор уникального счётчика.
 *
 * Возвращаемое замыкание увеличивает и возвращает внутреннее значение при каждом вызове.
 * Используется внешняя переменная, захваченная по ссылке.
 */
function makeCounter(): callable
{
    $count = 0;

    return function () use (&$count): int {
        $count++;

        return $count;
    };
}

/*
|--------------------------------------------------------------------------
| Демонстрация вызовов
|--------------------------------------------------------------------------
|
|
| php functions_deep.php
|
*/

/*
echo "=== isPrime ===\n";
foreach ([1, 2, 3, 4, 5, 9, 17, 66] as $n) {
    echo $n . ' => ' . (isPrime($n) ? 'true' : 'false') . "\n";
}

echo "\n=== fibonacci ===\n";
foreach ([0, 1, 2, 3, 4, 5, 10] as $n) {
    echo "fibonacci({$n}) = " . fibonacci($n) . "\n";
}

echo "\n=== formatPhone ===\n";
try {
    echo formatPhone('89123456789') . "\n";
    echo formatPhone('79123456789') . "\n";
} catch (InvalidArgumentException $e) {
    echo 'Ошибка: ' . $e->getMessage() . "\n";
}

echo "\n=== filterEvenNumbers ===\n";
$input = [1,2,3,4,5,6,7,8,9,10];
$evens = filterEvenNumbers($input);
echo 'Input: ' . json_encode($input, JSON_UNESCAPED_UNICODE) . "\n";
echo 'Evens: ' . json_encode($evens, JSON_UNESCAPED_UNICODE) . "\n";

echo "\n=== memoizedFactorial ===\n";
echo "5! = " . memoizedFactorial(5) . "\n";
echo "6! = " . memoizedFactorial(6) . "\n";
echo "6! (cached) = " . memoizedFactorial(6) . "\n";

echo "\n=== createUser (named arguments) ===\n";
$user = createUser(
    isActive: false,
    name: 'Maksim',
    email: 'maksim@example.com',
    age: 21
);
echo json_encode($user, JSON_UNESCAPED_UNICODE) . "\n";

echo "\n=== makeCounter ===\n";
$counterA = makeCounter();
$counterB = makeCounter();
echo "A: " . $counterA() . "\n";
echo "A: " . $counterA() . "\n";
echo "B: " . $counterB() . "\n";
echo "A: " . $counterA() . "\n";
*/
