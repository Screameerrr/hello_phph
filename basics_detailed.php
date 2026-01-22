<?php

/**
 * Задание 1
 */

function classifyAge(int $age): string
{
    if ($age < 12) {
        return "Ребенок"."<br>";

    }
    elseif ($age <= 17) {
        return "Подросток"."<br>";

    }
    elseif ($age >= 18) {
        return "Взрослый"."<br>";
    }

};

$testAge = [8,15,25];
foreach ($testAge as $age) {
    echo classifyAge($age);
}

echo "<hr>\n";


/**
 * Задание 2
 */

$cities = [
    "Москва",
    "Ростов",
    "Новгород",
    "Владивосток",
    "Екатеринбург"
];
foreach ($cities as $city) {
    $safecities = htmlspecialchars($city, ENT_QUOTES);
    echo $safecities."\n"."<br>";
}

echo "\n";
echo "\n";
echo "<hr>\n";


/**
 * Задание 3
 */

for ($i=1; $i<100; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz"."\n"."<br>";
        if ($i % 3 == 0) {
            echo "Fizz"."\n"."<br>";
            if ($i % 5 == 0) {
                echo "Buzz"."\n"."<br>";
            }
            else {
                echo $i."\n"."<br>";
            };
        }
    }
}
echo "\n";
echo "\n";
echo "<hr>\n";


/**
 * Задание 4
 */

function convertCelsiusToFahrenheit(float $celsius): float
{
    return $celsius * 9 / 5 + 32;
}
$testTemp = [0, 25, -10, 100];
foreach ($testTemp as $temp) {
    echo convertCelsiusToFahrenheit($temp) ."\n"."<br>";
}

echo "\n";
echo "\n";
echo "<hr>\n";


/**
 * Задание 5
 */

function getUserName(int|string $id): string|false
{
    if (is_int($id) && $id == 1) {
        return "Админ"."<br>";
    }
    elseif (is_string($id) && $id == "guest") {
        return "Гость"."<br>";
    }
    else{
        return false."<br>";
    }

}
$testIds = [1, "guest", 2];

foreach ($testIds as $testId) {
    $result = getUserName($testId);

    $idLabel = is_string($testId) ? "\"{$testId}\"" : (string)$testId;

    if ($result === false) {
        echo "id={$idLabel}: false\n";
    } else {
        echo "id={$idLabel}: {$result}\n";
    }
}
echo "\n";
echo "\n";
echo "<hr>\n";


/**
 * Задание 6
 */

function classifyAgeMatch(int $age): string
{
    return match (true) {
        $age < 12 => "Ребенок"."<br>",
        $age > 12 && $age < 17 => "Подросток"."<br>",
        default => "Взрослый"."<br>",
    };

}
$testAge = [55,3,15];
foreach ($testAge as $age) {
    echo classifyAgeMatch($age)."\n";
}