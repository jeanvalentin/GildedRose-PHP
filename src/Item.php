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
    public static $conjured = 'Conjured';

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

    public function updateQuality(): void
    {
        $this->computeQuality();
        $this->fixQuality();
        $this->computeSellIn();
    }

    private function computeQuality(): void
    {
        switch ($this->name) {
            case self::$aged:
                ++$this->quality;
                if ($this->sell_in <= 0) {
                    ++$this->quality;
                }
                break;
            case self::$backstage_passes:
                ++$this->quality;
                if ($this->sell_in <= 10) {
                    ++$this->quality;
                }
                if ($this->sell_in <= 5) {
                    ++$this->quality;
                }
                if ($this->sell_in <= 0) {
                    $this->quality = 0;
                }
                break;
            case self::$legendary:
                break;
            default:
                $quality_decrease = 1;
                if ($this->isConjured()) {
                    $quality_decrease *= 2;
                }
                $this->quality -= $quality_decrease;
                if ($this->sell_in <= 0) {
                    $this->quality -= $quality_decrease;
                }
                break;
        }
    }

    private function fixQuality(): void
    {
        if (self::$legendary === $this->name) {
            return;
        }
        if ($this->quality >= 50) {
            $this->quality = 50;
        }
        if ($this->quality <= 0) {
            $this->quality = 0;
        }
    }

    private function computeSellIn(): void
    {
        if (self::$legendary === $this->name) {
            return;
        }
        --$this->sell_in;
    }

    private function isConjured(): bool
    {
        return substr($this->name, 0, strlen(self::$conjured)) === self::$conjured;
    }
}
