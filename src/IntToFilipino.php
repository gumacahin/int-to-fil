<?php

namespace Gumacahin;

class IntToFilipino {

    const MIN = 0;

    const MAX = 999999999999999;

    const TO_19 = [
        'zero', 'isa', 'dalawa', 'tatlo', 'apat', 'lima', 'anim', 'pito',
        'walo', 'siyam', 'sampu', 'labing-isa', 'labing-dalawa', 'labing-tatlo',
        'labing-apat', 'labing-lima', 'labing-anim', 'labing-pito', 'labing-walo',
        'labing-siyam'
    ];

    const TENS = [
        '1' => 'sampu',
        '2' => 'dalawampu',
        '3' => 'tatlumpu',
        '4' => 'apatnapu',
        '5' => 'limampu', 
        '6' => 'animnampu',
        '7' => 'pitungpu',
        '8' => 'walungpu',
        '9' => 'siyamnapu',
    ];

    const HUNDREDS = [
        '1' => 'sandaan',
        '2' => 'dalawandaan',
        '3' => 'tatlundaan',
        '4' => 'apatnaraan',
        '5' => 'limandaan',
        '6' => 'animnaraan',
        '7' => 'pitundaan',
        '8' => 'walundaan',
        '9' => 'siyamnaraan',
    ];

    protected $number;

    protected $longForm;

    public function __construct($longForm=true) 
    {
        $this->longForm = $longForm;
    }

    public function setLongForm($flag=true)
    {
        $this->longForm = $flag;
        return $this;
    }

    public function getLongForm()
    {
        return $this->longForm;
    }

    public function say($number)
    {
        $this->setNumber($number);
        $oneTrillion = 1000000000000;
        $oneBillion  = 1000000000;
        $oneMillion  = 1000000;
        $oneThousand = 1000;

        $parts = [];
        // Trillions
        $trillions = intdiv($this->number, $oneTrillion);
        $remainder = $this->number % $oneTrillion;

        if ($trillions) {
            $parts[] = $this->attach($this->sayNumbersLessThan1000($trillions), 'trilyon');
        }

        // Billions
        $billions = intdiv($remainder, $oneBillion);
        $remainder %= $oneBillion;

        if ($billions) {
            $parts[] = $this->attach($this->sayNumbersLessThan1000($billions), 'bilyon');
        }

        // Millions
        $millions = intdiv($remainder, $oneMillion);
        $remainder %= $oneMillion;

        if ($millions) {
            $parts[] = $this->attach($this->sayNumbersLessThan1000($millions), 'milyon');
        }

        // Thousands
        $thousands = intdiv($remainder, $oneThousand);
        $remainder %= $oneThousand;

        if ($thousands) {
            $parts[] = $this->attach($this->sayNumbersLessThan1000($thousands), 'libo');
        }

        $parts[] = $this->sayNumbersLessThan1000($remainder);

        // To prevent 100 from being "sandaan at zero"
        if (count($parts) > 1 && $parts[count($parts) - 1] == 'zero') {
            array_pop($parts);
        }

        //if (count($parts) > 1) {
        //    $last = array_pop($parts);
        //    return join(', ', $parts) . ' at ' . $last;
        //}

        return join(', ', $parts);
    }

    protected function attach($word, $denomination)
    {
        if (in_array($word[strlen($word) - 1], ['a', 'e', 'i', 'o', 'u'])) {
            return "{$word}ng {$denomination}";
        }
        return "{$word} na {$denomination}";
    }

    protected function sayNumbersLessThan1000($number)
    {
        $parts = [];
        $hundreds = intdiv($number, 100);
        $remainder = $number % 100;

        if ($hundreds) {
            $parts[] = self::HUNDREDS[$hundreds];
        }

        if ($remainder < 20) {
            $parts[] =  self::TO_19[$remainder];
        } else {
            $tens = intdiv($remainder, 10);
            $remainder = $remainder % 10;

            if ($tens) {
                $parts[] = self::TENS[$tens];
            }

            $parts[] =  self::TO_19[$remainder];
        }

        // To prevent 100 from being "sandaan at zero"
        if (count($parts) > 1 && $parts[count($parts) - 1] == 'zero') {
            array_pop($parts);
        }

        if (count($parts) == 3) {
            return "{$parts[0]}, {$parts[1]} at {$parts[2]}";
        }

        if (count($parts) == 2) {
            return "{$parts[0]} at {$parts[1]}";
        }

        return $parts[0];
    }


    public function setNumber($number) 
    {

        if (!is_int($number)) {
            throw new \Exception("Can't say non-integers.");
        }

        if ($number < self::MIN) {
            throw new \Exception("Can't say numbers below {self:MIN}.");
        }

        if ($number > self::MAX) {
            throw new \Exception("Can't say numbers above {self::MAX}.");
        }

        $this->number = $number;

        return $this;
    }
}
