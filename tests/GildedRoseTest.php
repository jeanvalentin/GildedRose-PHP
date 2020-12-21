<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testItemGeneric(): void
    {
        $items = [new Item('+5 Dexterity Vest', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('+5 Dexterity Vest', $items[0]->name);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(19, $items[0]->quality);
    }

    public function testItemGenericQualityZero(): void
    {
        $items = [new Item('+5 Dexterity Vest', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('+5 Dexterity Vest', $items[0]->name);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testItemGenericSellInZero(): void
    {
        $items = [new Item('+5 Dexterity Vest', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('+5 Dexterity Vest', $items[0]->name);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(18, $items[0]->quality);
    }

    public function testItemAged(): void
    {
        $items = [new Item('Aged Brie', 2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(1, $items[0]->sell_in);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testItemAgedSellInZero(): void
    {
        $items = [new Item('Aged Brie', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(2, $items[0]->quality);
    }

    public function testItemAgedQualityFifty(): void
    {
        $items = [new Item('Aged Brie', 2, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(1, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testItemLegendary(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testItemBackstagePasses(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(14, $items[0]->sell_in);
        $this->assertSame(21, $items[0]->quality);
    }

    public function testItemBackstagePassesQualityFifty(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(14, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testItemBackstagePassesSellInTenOrLess(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(22, $items[0]->quality);
    }

    public function testItemBackstagePassesSellInFiveOrLess(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(23, $items[0]->quality);
    }

    public function testItemBackstagePassesSellInZeroOrLess(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testItemConjured(): void
    {
        $items = [new Item('Conjured Mana Cake', 3, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Conjured Mana Cake', $items[0]->name);
        $this->assertSame(2, $items[0]->sell_in);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testItemConjuredSellInZero(): void
    {
        $items = [new Item('Conjured +5 Dexterity Vest', 0, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Conjured +5 Dexterity Vest', $items[0]->name);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(2, $items[0]->quality);
    }
}
