<?php
declare(strict_types=1);

function classifyAge(int $age): string
{
    if ($age < 12) {
        return 'Ребёнок';
    } elseif ($age < 18) {
        return 'Подросток';
    }
    return 'Взрослый';
}

$isCli = (PHP_SAPI === 'cli');
$br = $isCli ? PHP_EOL : '<br>';
$h2Open = $isCli ? '' : '<h2>';
$h2Close = $isCli ? $br : '</h2>';

echo $h2Open . 'Проверка функции classifyAge' . $h2Close;
echo basics_detailed . phpclassifyAge(45) . $br;
echo basics_detailed . phpclassifyAge(3) . $br;
echo basics_detailed . phpclassifyAge(4) . $br;

echo $br . $h2Open . 'Список городов' . $h2Close;

$cities = ['Москва', 'Санкт-Петербург', 'Новосибирск', 'Екатеринбург', 'Казань'];

if ($isCli) {
    foreach ($cities as $city) {
        echo '- ' . $city . $br;
    }
} else {
    echo '<ul>';
    foreach ($cities as $city) {
        echo '<li>' . htmlspecialchars($city, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul>';
}

echo $br . $h2Open . 'FizzBuzz (1–100)' . $h2Close;

for ($i = 1; $i <= 100; $i++) {
    if ($i % 15 === 0) {
        echo 'FizzBuzz';
    } elseif ($i % 3 === 0) {
        echo 'Fizz';
    } elseif ($i % 5 === 0) {
        echo 'Buzz';
    } else {
        echo $i;
    }
    echo $br;
}

