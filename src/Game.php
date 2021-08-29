<?php declare(strict_types=1);

namespace Barryosull\PSDeals;

class Game
{
    public $name;
    public $price;

    public function __construct(string $name, string $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
