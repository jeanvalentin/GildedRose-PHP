<?php

declare(strict_types=1);

namespace GildedRose;

final class Item
{
    /**
     * @var string
     */
    public static $aged = 'Aged Brie';

    /**
     * @var string
     */
    public static $backstage_passes = 'Backstage passes to a TAFKAL80ETC concert';

    /**
     * @var string
     */
    public static $legendary = 'Sulfuras, Hand of Ragnaros';

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $sell_in;

    /**
     * @var int
     */
    public $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}
