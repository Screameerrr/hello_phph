<?php
/**
 * Генерирует HTML-шаблон письма с использованием heredoc (с интерполяцией переменных).
 */
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

/**
 * Возвращает пример текста в формате nowdoc (без интерполяции).
 * Удобно для вывода примеров кода/шаблонов без подстановки переменных.
 */
function generateNowdocExample(): string
{
    $example = <<<'TXT'
Пример кода (nowdoc — переменные НЕ интерполируются):
$name = "Иван";
echo "Привет, $name"; // выведет именно $name, а не значение
TXT;

    return $example;
}

/**
 * Возвращает первый и последний символ строки (Unicode-safe) с помощью mb_*.
 * Корректно работает с кириллицей и эмодзи при включённой mbstring.
 */
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

/**
 * Собирает полное имя из имени и фамилии, удаляя пробелы по краям.
 * Если один из компонентов пустой — корректно возвращает второй без лишнего пробела.
 */
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

/**
 * Приводит каждое слово к виду "С заглавной буквы" с поддержкой Unicode.
 * Аналог ucwords(), но на mb_*.
 */
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

/**
 * Извлекает имя файла из полного пути.
 * Пример: "/var/www/index.php" -> "index.php"
 * Если слеша нет — возвращает исходную строку.
 */
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

/**
 * Объединяет массив тегов в CSV-строку через ", ".
 * Пустые/пробельные элементы игнорируются.
 */
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

/**
 * Преобразует CSV-строку тегов обратно в массив.
 * Учитывает пробелы вокруг запятых: "php, regex, web" -> ["php","regex","web"]
 * Пустые элементы игнорируются.
 */
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

/**
 * Безопасно готовит пользовательский ввод к выводу в HTML.
 */
function safeEcho(string $userInput): string
{
    return htmlspecialchars($userInput, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Формирует URL поиска вида "https://example.com/search?q=..."
 * Значение q кодируется через rawurlencode().
 */
function buildSearchUrl(string $query): string
{
    return 'https://example.com/search?q=' . rawurlencode($query);
}

/**
 * Проверяет пароль одним регулярным выражением (с упреждающими проверками):
 * - минимум 8 символов
 * - хотя бы одна заглавная буква
 * - хотя бы одна цифра
 */
function validatePassword(string $pass): bool
{
    if ($pass === '') {
        return false;
    }

    return preg_match('/^(?=.{8,})(?=.*\p{Lu})(?=.*\d).+$/u', $pass) === 1;
}

/**
 * Извлекает все email-адреса из текста с помощью preg_match_all().
 * Используется простой, но практичный шаблон. Флаги i и u.
 */
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

/**
 * Оборачивает все числа в тексте в тег <mark>...</mark>.
 * Поддерживаются целые и десятичные числа:
 * - 12
 * - 12.34
 * - 12,34
 */
function highlightNumbers(string $text): string
{
    if ($text === '') {
        return '';
    }

    // Число: \d+ и необязательная дробная часть через . или ,
    return preg_replace('/\d+(?:[.,]\d+)?/u', '<mark>$0</mark>', $text) ?? $text;
}

/*
|--------------------------------------------------------------------------
| Демонстрация вызовов
|--------------------------------------------------------------------------
|
*/

/*
echo "=== generateEmailTemplate (heredoc) ===\n";
echo generateEmailTemplate('Максим', 'Курс PHP 8') . "\n\n";

echo "=== nowdoc example ===\n";
echo generateNowdocExample() . "\n\n";

echo "=== getFirstAndLastChar ===\n";
print_r(getFirstAndLastChar('Привет'));
print_r(getFirstAndLastChar('🙂Ок🙂'));
print_r(getFirstAndLastChar(''));
echo "\n";

echo "=== buildFullName ===\n";
echo buildFullName('  Иван  ', '  Петров ') . "\n";
echo buildFullName('Иван', '') . "\n";
echo buildFullName('', 'Петров') . "\n\n";

echo "=== toTitleCase ===\n";
echo toTitleCase('привет мир') . "\n";
echo toTitleCase('  вОТ   тАкОЙ   тЕкСт 🙂  ') . "\n\n";

echo "=== extractFileName ===\n";
echo extractFileName('/var/www/index.php') . "\n";
echo extractFileName('index.php') . "\n";
echo extractFileName('') . "\n\n";

echo "=== tagListToCSV / csvToTagList ===\n";
$tags = [' php ', 'regex', '  ', 'web'];
$csv = tagListToCSV($tags);
echo $csv . "\n";
print_r(csvToTagList('php, regex, web'));
print_r(csvToTagList(' php ,  regex,web  , '));
echo "\n";

echo "=== safeEcho ===\n";
echo safeEcho('<script>alert("xss")</script>') . "\n\n";

echo "=== buildSearchUrl ===\n";
echo buildSearchUrl('php regex кириллица 🙂') . "\n\n";

echo "=== validatePassword ===\n";
var_dump(validatePassword('Passw0rd'));      // true
var_dump(validatePassword('password1'));     // false (нет заглавной)
var_dump(validatePassword('PASSWORD'));      // false (нет цифры, <8?)
var_dump(validatePassword('Abcdefg1'));      // true
echo "\n";

echo "=== extractEmails ===\n";
$text = 'Почты: test@example.com, Admin+1@site.org и невалидная a@b. Ещё: user.name@domain.co';
print_r(extractEmails($text));
echo "\n";

echo "=== highlightNumbers ===\n";
echo highlightNumbers('Цена 12.50, скидка 10%, итого 2,5 раза.') . "\n";
*/
