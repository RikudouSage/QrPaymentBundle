<?php

namespace Rikudou\QrPaymentBundle\QrPayment\Helper;

use rikudou\EuQrPayment\Sepa\CharacterSet;

class CharacterSetStringToConstant
{

    public static function getConstant(string $key)
    {
        switch ($key) {
            case "utf-8":
                return CharacterSet::UTF_8;
            case "iso-8859-1":
                return CharacterSet::ISO_8859_1;
            case "iso-8859-2":
                return CharacterSet::ISO_8859_2;
            case "iso-8859-4":
                return CharacterSet::ISO_8859_4;
            case "iso-8859-5":
                return CharacterSet::ISO_8859_5;
            case "iso-8859-7":
                return CharacterSet::ISO_8859_7;
            case "iso-8859-10":
                return CharacterSet::ISO_8859_10;
            case "iso-8859-15":
                return CharacterSet::ISO_8859_15;
        }

        throw new \InvalidArgumentException("The string '{$key}' is not a valid key for a character set");
    }

}
