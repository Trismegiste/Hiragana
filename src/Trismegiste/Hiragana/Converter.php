<?php

/*
 * Hiragana
 */

namespace Trismegiste\Hiragana;

use Trismegiste\WamBundle\Prolog\WAMService;

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

    public function __construct()
    {
        $this->wam = new WAMService();
        $this->wam->runQuery("consult('" . __DIR__ . "/rules.pro').");
    }

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
                    return chr(0xe3) . chr(0x82) . chr(0x99) . $this->charMap[$kana];
                case 'handa':
                    return chr(0xe3) . chr(0x82) . chr(0x9a) . $this->charMap[$kana];
            }
        }
    }

}