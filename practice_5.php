<?php

/**
 * Задание 1
 */
function getBookTitles(array $books): array
{
    $titles = [];

    foreach ($books as $book) {
        if (isset($book['title']) && is_string($book['title'])) {
            $titles[] = $book['title'];
        }
    }

    return $titles;
}

/**
 * Задание 2
 */
function hasBookByAuthor(array $books, string $author): bool
{
    $author = mb_strtolower($author, 'UTF-8');

    foreach ($books as $book) {
        if (isset($book['author']) && is_string($book['author'])) {
            if (mb_strtolower($book['author'], 'UTF-8') === $author) {
                return true;
            }
        }
    }

    return false;
}

/**
 * Задание 3
 */
function addDefaultYear(array $books, int $defaultYear = 2025): array
{
    $result = [];

    foreach ($books as $book) {
        $copy = $book;

        if (!array_key_exists('year', $copy)) {
            $copy['year'] = $defaultYear;
        }

        $result[] = $copy;
    }

    return $result;
}

/**
 * Задание 4
 */
function filterBooksByYear(array $books, int $minYear): array
{
    $result = [];

    foreach ($books as $book) {
        if (isset($book['year']) && is_int($book['year']) && $book['year'] > $minYear) {
            $result[] = $book;
        }
    }

    return $result;
}

/**
 * Задание 5
 */
function mapBooksToPairs(array $books): array
{
    $result = [];

    foreach ($books as $book) {
        $title = $book['title'] ?? '';
        $author = $book['author'] ?? '';
        $year = isset($book['year']) && is_int($book['year'])
            ? (string) $book['year']
            : 'неизвестен';

        $result[] = "{$title} ({$author}, {$year})";
    }

    return $result;
}

/**
 * Задание 6
 */
function sortBooks(array $books): array
{
    $sorted = $books;

    usort(
        $sorted,
        function (array $a, array $b): int {
            $yearA = isset($a['year']) && is_int($a['year']) ? $a['year'] : PHP_INT_MAX;
            $yearB = isset($b['year']) && is_int($b['year']) ? $b['year'] : PHP_INT_MAX;

            if ($yearA !== $yearB) {
                return $yearA <=> $yearB;
            }

            $titleA = mb_strtolower($a['title'] ?? '', 'UTF-8');
            $titleB = mb_strtolower($b['title'] ?? '', 'UTF-8');

            return strcoll($titleA, $titleB);
        }
    );

    return $sorted;
}

/**
 * Задание 7
 */
function groupBy(array $items, string $key): array
{
    $result = [];

    foreach ($items as $item) {
        if (!array_key_exists($key, $item)) {
            continue;
        }

        $groupKey = (string) $item[$key];
        $result[$groupKey][] = $item;
    }

    return $result;
}

/**
 * Задание 8
 */
function stackPush(array &$stack, mixed $value): void
{
    $stack[] = $value;
}

/**
 * @param array<int, mixed> $stack
 *
 * @return mixed
 */
function stackPop(array &$stack): mixed
{
    return $stack === [] ? null : array_pop($stack);
}

/**
 * Задание 9
 */
function queueEnqueue(array &$queue, mixed $value): void
{
    $queue[] = $value;
}

/**
 * @param array<int, mixed> $queue
 *
 * @return mixed
 */
function queueDequeue(array &$queue): mixed
{
    return $queue === [] ? null : array_shift($queue);
}

/**
 * Задание 10
 */
function safeGet(array $array, string|int $key, mixed $default = null): mixed
{
    return array_key_exists($key, $array) ? $array[$key] : $default;
}

/**
 * Задание 11
 */
function isAssociative(array $array): bool
{
    $expected = 0;

    foreach ($array as $key => $_value) {
        if (!is_int($key) || $key !== $expected) {
            return true;
        }
        $expected++;
    }

    return false;
}

/*
Задание 12

$books = [
    ['title' => '1984', 'author' => 'Оруэлл', 'year' => 1949],
    ['title' => 'Мастер и Маргарита', 'author' => 'Булгаков', 'year' => 1967],
    ['title' => 'Преступление и наказание', 'author' => 'Достоевский', 'year' => 1866],
    ['title' => 'Собачье сердце', 'author' => 'Булгаков'],
    ['title' => 'Война и мир', 'author' => 'Толстой', 'year' => 1869],
];

getBookTitles($books);
hasBookByAuthor($books, 'булгаков');
addDefaultYear($books);
filterBooksByYear($books, 1900);
mapBooksToPairs($books);
sortBooks($books);
groupBy($books, 'author');

$stack = [];
stackPush($stack, 1);
stackPop($stack);

$queue = [];
queueEnqueue($queue, 1);
queueDequeue($queue);

safeGet(['a' => 1], 'a', 0);
isAssociative(['a' => 1, 'b' => 2]);
*/