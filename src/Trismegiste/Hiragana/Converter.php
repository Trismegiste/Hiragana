<?php

/*
 * Hiragana
 */

namespace Trismegiste\Hiragana;

use Trismegiste\Prolog\PrologContext;

/**
 * Converter converts Hepburn notation to Hiragana
 */
class Converter
{

    protected $wam;
    protected $charMap = array(
        'a' => 'あ',
        'i' => 'い',
        'u' => 'う',
        'e' => 'え',
        'o' => 'お',
        'ka' => 'か',
        'ki' => 'き',
        'ku' => 'く',
        'ke' => 'け',
        'ko' => 'こ',
        'sa' => 'さ',
        'shi' => 'し',
        'su' => 'す',
        'se' => 'せ',
        'so' => 'そ',
        'ta' => 'た',
        'chi' => 'ち',
        '[tsu, small]' => 'っ',
        'tsu' => 'つ',
        'te' => 'て',
        'to' => 'と',
        'na' => 'な',
        'ni' => 'に',
        'nu' => 'ぬ',
        'ne' => 'ね',
        'no' => 'の',
        'ha' => 'は',
        'hi' => 'ひ',
        'fu' => 'ふ',
        'he' => 'へ',
        'ho' => 'ほ',
        'ma' => 'ま',
        'mi' => 'み',
        'mu' => 'む',
        'me' => 'め',
        'mo' => 'も',
        '[ya, small]' => 'ゃ',
        'ya' => 'や',
        '[yu, small]' => 'ゅ',
        'yu' => 'ゆ',
        '[yo, small]' => 'ょ',
        'yo' => 'よ',
        'ra' => 'ら',
        'ri' => 'り',
        'ru' => 'る',
        're' => 'れ',
        'ro' => 'ろ',
        'wa' => 'わ',
        'wo' => 'を',
        'n' => 'ん'
    );

    public function __construct(PrologContext $wam)
    {
        $this->wam = $wam;
        $this->wam->loadProlog(__DIR__ . '/rules.pro');
    }

    /**
     * Convert a word in hepburn to hiragana
     * 
     * @param string $str
     * 
     * @return array an array of string results
     */
    public function toHiragana($str)
    {
        $exploded = implode(',', str_split($str));
        $solution = $this->wam->runQuery("solve([$exploded], X).");

        $japanese = array();
        foreach ($solution as $row) {
            if ($row->succeed) {
                $word = array();
                $computed = $row->getQueryVars()['X'];
                foreach ($computed as $char) {
                    $word[] = $this->map($char);
                }
                $japanese[] = implode('', $word);
            }
        }

        return $japanese;
    }

    /**
     * UTF-8 transform
     * 
     * @param string|object $char a char or a list of a char and modifier
     * 
     * @return string the utf-8 character (multibyte of course)
     */
    protected function map($char)
    {
        if (is_string($char)) {
            return $this->charMap[$char];
        } else {
            $kana = $char[0];
            $modifier = $char[1];
            switch ($modifier) {
                case 'small' :
                    return $this->charMap[(string) $char];
                case 'daku':
                    return $this->charMap[$kana] . "\xe3\x82\x99";
                case 'handa':
                    return $this->charMap[$kana] . "\xe3\x82\x9a";
            }
        }
    }

}
