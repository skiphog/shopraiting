<?php

use Illuminate\Support\Str;

function _trim(mixed $value): string
{
    $value = str_replace(['&nbsp;', "\r\n", "\r", "\n"], [' ', '', '', ''], (string)$value);
    $value = Str::squish($value);

    return preg_replace('~^[\s﻿]+|[\s﻿]+$~u', '', $value) ?? trim($value);
}

/**
 * @param mixed $value
 * @param int   $flag
 * @param bool  $pretty
 * @param int   $depth
 *
 * @return string
 * @noinspection JsonEncodingApiUsageInspection
 */
function _json(
    mixed $value,
    int $flag = JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE | JSON_INVALID_UTF8_SUBSTITUTE,
    bool $pretty = false,
    int $depth = 512
): string {
    return json_encode($value, $pretty ? ($flag | JSON_PRETTY_PRINT) : $flag, $depth);
}

/**
 * @param string $string
 *
 * @return string
 */
function _content(string $string): string
{
    $h2 = 1;
    $h3 = 1;

    return preg_replace_callback_array([
        '~<h2[^>]*?>(.+?)</h2>~' => function ($match) use (&$h2) {
            return '<h2 id="keep-h2-' . $h2++ . '">' . $match[1] . '</h2>';
        },
        '~<h3[^>]*?>(.+?)</h3>~' => function ($match) use (&$h3) {
            return '<h3 id="keep-h3-' . $h3++ . '">' . $match[1] . '</h3>';
        }
    ], $string);
}

/**
 * @param string $string
 *
 * @return array
 */
function _contents(string $string): array
{
    $contents = [];

    preg_match_all('~<h([23]) id="([^"]+?)">(.+?)</h~', $string, $matches);
    if (!empty($matches[1])) {
        foreach ($matches[1] as $key => $item) {
            if (2 === (int)$item
                || empty($contents[$cnt = count($contents) - 1])
                || !str_contains($contents[$cnt]['link'], 'h2')
            ) {
                $contents[$key] = [
                    'link'  => "#{$matches[2][$key]}",
                    'title' => _trim(strip_tags($matches[3][$key])),
                    'child' => []
                ];
                continue;
            }

            $contents[$cnt]['child'][] = [
                'link'  => "#{$matches[2][$key]}",
                'title' => _trim(strip_tags($matches[3][$key])),
            ];
        }
    }

    return array_values($contents);
}

/**
 * Время для прочтения строки
 *
 * @param string $string
 *
 * @return int
 */
function _timeToRead(string $string): int
{
    $string = preg_replace('/[^A-zА-яё\d]/ui', '', strip_tags($string));
    $count = mb_strlen($string);

    return (int)ceil($count / 1500);
}