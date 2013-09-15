# Hepburn to Hiragana

A converter from Hepburn notation (or approximation) to Hiragana

-- alpha release untested --

## What

This is a PHP 5.4 library for converting japanese words written in **Hepburn** notation(s) 
(i.e in western letters) to **hiragana** phonetic letters.

```
nippon => にっ゚ほん
toukyou => とうきょう
shinjuku => しん゙しゅく
shinjyuku => しん゙しゅく
taishakuten => たいしゃくてん
```

## Why

This tool was primarily designed for massive conversion of japanese first and last names from
a database, it is NOT intended to convert or translate full text with foreign words.

It does not support katakana nor foreign phonem like 'fa', 'va' or old stuff
like 'wi' or 'we'. If you have single quote in word (like the first name 
Jun'ichiro), split the string. Convert all letters to lower case.

Since Hepburn translation is not a bijection, the converter returns an array 
with zero, one or many solutions. 

## How

### Install it

git clone & composer install are your friends

### Using it

```php
use Trismegiste\Hiragana\Converter;

$obj = new Converter();
$result = $obj->toHiragana("suiseiseki");
echo $result[0];
// outputs 'すいせいせき'
```

The initialisation of this Converter is very slow, because it compiles a Prolog
program, but for a batch converter, it's not an issue. If you want to convert
names within a web environment, I suggest you to compile the prolog code into WAM
code and cache it.

There is a CLI demo :
```
$ php demo.php sakurazukamori

Array
(
    [0] => さくら゙つかもり
    [1] => さくら゙すかもり
)
```

## Where

Since this tool is full utf-8, don't expect to output hiragana in the crappy
console of Windows(c)(r)(tm).

## Todo

Prolog tests and php tests