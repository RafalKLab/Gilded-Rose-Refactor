<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function test_aged_brie_type_before_sell_in_date_updates_normally(): void
    {
        $items = [new Item('Aged Brie', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->quality);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_aged_brie_type_on_sell_in_date_updates_normally(): void
    {
        $items = [new Item('Aged Brie', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(12, $items[0]->quality);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_aged_brie_type_after_sell_in_date_updates_normally(): void
    {
        $items = [new Item('Aged Brie', -5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(12, $items[0]->quality);
        $this->assertSame(-6, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_aged_brie_type_before_sell_in_date_with_maximum_quality(): void
    {
        $items = [new Item('Aged Brie', 5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_aged_brie_type_on_sell_in_date_near_maximum_quality(): void
    {
        $items = [new Item('Aged Brie', 0, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_aged_brie_type_on_sell_in_date_with_maximum_quality(): void
    {
        $items = [new Item('Aged Brie', 0, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_aged_brie_type_after_sell_in_date_with_maximum_quality(): void
    {
        $items = [new Item('Aged Brie', -10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
        $this->assertSame(-11, $items[0]->sell_in);
        $this->assertSame('Aged Brie', $items[0]->name);
    }

    public function test_backstage_pass_before_sell_on_date_updates_normally(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(12, $items[0]->quality);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_backstage_pass_more_than_ten_days_before_sell_on_date_updates_normally(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 11, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->quality);
        $this->assertSame(10, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_backstage_pass_updates_by_three_with_five_days_left_to_sell(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(13, $items[0]->quality);
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_backstage_pass_drops_to_zero_after_sell_in_date(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_backstage_pass_close_to_sell_in_date_with_max_quality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_backstage_pass_very_close_to_sell_in_date_with_max_quality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_backstage_pass_quality_zero_after_sell_date_with_max_quality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', -5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
        $this->assertSame(-6, $items[0]->sell_in);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
    }

    public function test_sulfuras_before_sell_in_date(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(80, $items[0]->quality);
        $this->assertSame(10, $items[0]->sell_in);
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
    }

    public function test_sulfuras_on_sell_in_date(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
        $this->assertSame(10, $items[0]->sell_in);
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
    }

    public function test_sulfuras_after_sell_in_date(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(10, $items[0]->quality);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
    }

    public function test_casual_item_before_dell_in_date(): void
    {
        $items = [new Item('basic', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->quality);
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame('basic', $items[0]->name);
    }

    public function test_casual_item_on_sell_in_date(): void
    {
        $items = [new Item('basic', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(8, $items[0]->quality);
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame('basic', $items[0]->name);
    }

    public function test_casual_item_after_sell_in_date(): void
    {
        $items = [new Item('basic', -5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(8, $items[0]->quality);
        $this->assertSame(-6, $items[0]->sell_in);
        $this->assertSame('basic', $items[0]->name);
    }

}
