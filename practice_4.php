<?php

// Задание 1
function generateEmailTemplate(string $name, string $product): string
{
    $safeName = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeProduct = htmlspecialchars($product, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    $html = <<<HTML
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ваш заказ</title>
</head>
<body>
    <h1>Здравствуйте, {$safeName}!</h1>
    <p>Спасибо за интерес к продукту: <strong>{$safeProduct}</strong>.</p>
    <p>Если у вас есть вопросы — просто ответьте на это письмо.</p>
</body>
</html>
HTML;

    return $html;
}


function generateNowdocExample(): string
{
    $example = <<<'TXT'
Пример кода (nowdoc — переменные НЕ интерполируются):
$name = "Иван";
echo "Привет, $name"; // выведет именно $name, а не значение
TXT;

    return $example;
}

// Задание 2
function getFirstAndLastChar(string $str): array
{
    $encoding = 'UTF-8';

    if ($str === '') {
        return ['first' => '', 'last' => ''];
    }

    $length = mb_strlen($str, $encoding);
    if ($length === 0) {
        return ['first' => '', 'last' => ''];
    }

    $first = mb_substr($str, 0, 1, $encoding);
    $last = mb_substr($str, $length - 1, 1, $encoding);

    return ['first' => $first, 'last' => $last];
}

// Задание 3
function buildFullName(string $first, string $last): string
{
    $first = trim($first);
    $last = trim($last);

    if ($first === '') {
        return $last;
    }

    if ($last === '') {
        return $first;
    }

    return $first . ' ' . $last;
}

// Задание 4
function toTitleCase(string $phrase): string
{
    $encoding = 'UTF-8';
    $phrase = trim($phrase);

    if ($phrase === '') {
        return '';
    }

    $words = preg_split('/\s+/u', $phrase);
    if ($words === false) {
        return '';
    }

    $result = [];

    foreach ($words as $word) {
        if ($word === '') {
            continue;
        }

        $firstChar = mb_substr($word, 0, 1, $encoding);
        $rest = mb_substr($word, 1, null, $encoding);

        $result[] = mb_strtoupper($firstChar, $encoding) . mb_strtolower($rest, $encoding);
    }

    return implode(' ', $result);
}

// Задание 5
function extractFileName(string $path): string
{
    if ($path === '') {
        return '';
    }

    $pos = strrpos($path, '/');
    if ($pos === false) {
        return $path;
    }

    return substr($path, $pos + 1);
}

// Задание 6
function tagListToCSV(array $tags): string
{
    $clean = [];

    foreach ($tags as $tag) {
        $t = trim((string)$tag);
        if ($t !== '') {
            $clean[] = $t;
        }
    }

    return implode(', ', $clean);
}

// Задание 6
function csvToTagList(string $csv): array
{
    $csv = trim($csv);
    if ($csv === '') {
        return [];
    }

    $parts = explode(',', $csv);
    $tags = [];

    foreach ($parts as $part) {
        $t = trim($part);
        if ($t !== '') {
            $tags[] = $t;
        }
    }

    return $tags;
}

// Задание 7
function safeEcho(string $userInput): string
{
    return htmlspecialchars($userInput, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Задание 8
function buildSearchUrl(string $query): string
{
    return 'https://example.com/search?q=' . rawurlencode($query);
}

// Задание 9
function validatePassword(string $pass): bool
{
    if ($pass === '') {
        return false;
    }

    return preg_match('/^(?=.{8,})(?=.*\p{Lu})(?=.*\d).+$/u', $pass) === 1;
}

// Задание 10
function extractEmails(string $text): array
{
    if ($text === '') {
        return [];
    }

    $pattern = '/\b[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}\b/iu';

    $matches = [];
    $ok = preg_match_all($pattern, $text, $matches);

    if ($ok === false || $ok === 0) {
        return [];
    }

    return $matches[0];
}

// Задание 11
function highlightNumbers(string $text): string
{
    if ($text === '') {
        return '';
    }

    return preg_replace('/\d+(?:[.,]\d+)?/u', '<mark>$0</mark>', $text) ?? $text;
}

// Задание 1
/*
echo "=== generateEmailTemplate (heredoc) ===\n";
echo generateEmailTemplate('Максим', 'Курс PHP 8') . "\n\n";

echo "=== nowdoc example ===\n";
echo generateNowdocExample() . "\n\n";
*/

// Задание 2
/*
echo "=== getFirstAndLastChar ===\n";
print_r(getFirstAndLastChar('Привет'));
print_r(getFirstAndLastChar('🙂Ок🙂'));
print_r(getFirstAndLastChar(''));
echo "\n";
*/

// Задание 3
/*
echo "=== buildFullName ===\n";
echo buildFullName('  Иван  ', '  Петров ') . "\n";
echo buildFullName('Иван', '') . "\n";
echo buildFullName('', 'Петров') . "\n\n";
*/

// Задание 4
/*
echo "=== toTitleCase ===\n";
echo toTitleCase('привет мир') . "\n";
echo toTitleCase('  вОТ   тАкОЙ   тЕкСт 🙂  ') . "\n\n";
*/

// Задание 5
/*
echo "=== extractFileName ===\n";
echo extractFileName('/var/www/index.php') . "\n";
echo extractFileName('index.php') . "\n";
echo extractFileName('') . "\n\n";
*/

// Задание 6
/*
echo "=== tagListToCSV / csvToTagList ===\n";
$tags = [' php ', 'regex', '  ', 'web'];
$csv = tagListToCSV($tags);
echo $csv . "\n";
print_r(csvToTagList('php, regex, web'));
print_r(csvToTagList(' php ,  regex,web  , '));
echo "\n";
*/

// Задание 7
/*
echo "=== safeEcho ===\n";
echo safeEcho('<script>alert("xss")</script>') . "\n\n";
*/

// Задание 8
/*
echo "=== buildSearchUrl ===\n";
echo buildSearchUrl('php regex кириллица 🙂') . "\n\n";
*/

// Задание 9
/*
echo "=== validatePassword ===\n";
var_dump(validatePassword('Passw0rd'));
var_dump(validatePassword('password1'));
var_dump(validatePassword('PASSWORD'));
var_dump(validatePassword('Abcdefg1'));
echo "\n";
*/

// Задание 10
/*
echo "=== extractEmails ===\n";
$text = 'Почты: test@example.com, Admin+1@site.org и невалидная a@b. Ещё: user.name@domain.co';
print_r(extractEmails($text));
echo "\n";
*/

// Задание 11
/*
echo "=== highlightNumbers ===\n";
echo highlightNumbers('Цена 12.50, скидка 10%, итого 2,5 раза.') . "\n";
*/
