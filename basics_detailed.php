<?php
declare(strict_types=1);

/**
 * Задание 1. Функция классификации возраста (if/elseif/else)
 */
function classifyAge(int $age): string
{
    if ($age < 12) {
        return 'Ребёнок';
    } elseif ($age <= 17) {
        return 'Подросток';
    } else {
        return 'Взрослый';
    }
}

/**
 * Задание 4. Конвертер температур
 * F = C * 9/5 + 32
 */
function convertCelsiusToFahrenheit(float $celsius): float
{
    return $celsius * 9 / 5 + 32;
}

/**
 * Задание 5. Union types
 */
function getUserName(int|string $id): string|false
{
    if (is_int($id) && $id === 1) {
        return 'Администратор';
    }

    if (is_string($id) && $id === 'guest') {
        return 'Гость';
    }

    return false;
}

/**
 * Задание 6. classifyAge через match.
 * match не умеет диапазоны напрямую, поэтому делаем match(true)
 * и подставляем булевы выражения.
 */
function classifyAgeMatch(int $age): string
{
    return match (true) {
        $age < 12 => 'Ребёнок',
        $age >= 12 && $age <= 17 => 'Подросток',
        default => 'Взрослый',
    };
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP Basics Detailed</title>
</head>
<body>

<h2>Задание 1 — classifyAge (if/elseif/else) + тесты</h2>
<?php
$ageTests = [8, 15, 25];
foreach ($ageTests as $age) {
    echo 'Возраст ' . $age . ' → ' . classifyAge($age) . '<br>';
}
?>

<h2>Задание 2 — Список городов (foreach + htmlspecialchars)</h2>
<?php
$cities = [
        'Москва',
        'Санкт-Петербург',
        'Новосибирск',
        'Екатеринбург',
        'Казань',
];

echo '<ul>';
foreach ($cities as $city) {
    echo '<li>' . htmlspecialchars($city, ENT_QUOTES, 'UTF-8') . '</li>';
}
echo '</ul>';
?>

<h2>Задание 3 — FizzBuzz (1–100, for + %)</h2>
<?php
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
        echo 'FizzBuzz';
    } elseif ($i % 3 === 0) {
        echo 'Fizz';
    } elseif ($i % 5 === 0) {
        echo 'Buzz';
    } else {
        echo $i;
    }
    echo '<br>';
}
?>

<h2>Задание 4 — convertCelsiusToFahrenheit + тесты</h2>
<?php
$tempTests = [0.0, 25.0, -10.0, 100.0];

foreach ($tempTests as $c) {
    $f = convertCelsiusToFahrenheit($c);
    // Округлим для красоты вывода, логика функции при этом не меняется
    echo $c . ' °C → ' . round($f, 2) . ' °F<br>';
}
?>

<h2>Задание 5 — getUserName (union types) + тесты (с проверкой === false)</h2>
<?php
$userTests = [
        1,
        'guest',
        2,          // любой другой int
        'admin',    // любая другая строка
];

foreach ($userTests as $testId) {
    $result = getUserName($testId);

    $idText = is_int($testId) ? (string)$testId : '"' . $testId . '"';

    if ($result === false) {
        echo 'getUserName(' . $idText . ') → false<br>';
    } else {
        echo 'getUserName(' . $idText . ') → ' . htmlspecialchars($result, ENT_QUOTES, 'UTF-8') . '<br>';
    }
}
?>

<h2>Задание 6 — classifyAgeMatch (match) + сравнение с заданием 1</h2>
<?php
$ageTests2 = [8, 12, 17, 18, 25];

foreach ($ageTests2 as $age) {
    $a1 = classifyAge($age);
    $a2 = classifyAgeMatch($age);

    echo 'Возраст ' . $age . ' → if: ' . $a1 . ' | match: ' . $a2;

    // небольшая проверка, что обе версии дают одинаковый результат
    echo ($a1 === $a2) ? ' ✅' : ' ❌';
    echo '<br>';
}
?>



</body>
</html>
