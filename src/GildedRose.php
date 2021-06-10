<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item -> name) {
                case 'Aged Brie':
                    $item->quality ++;
                    $item->sell_in --;
                    if($item->sell_in <= 0) $item->quality ++;
                    if($item->quality > 50) $item->quality = 50;
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $item->quality ++;
                    if($item->sell_in <= 10) $item->quality ++;
                    if($item->sell_in <= 5) $item->quality ++;
                    if($item->sell_in <= 0) $item->quality = 0;
                    if($item->quality > 50) $item->quality = 50;
                    $item->sell_in --;
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    break;
                case 'Conjured':
                    $item->quality -= 2;
                    if($item->sell_in <= 0) $item->quality -= 2;
                    if($item->quality < 0) $item->quality = 0;
                    $item->sell_in --;
                    break;
                default:
                    $item->quality --;
                    if($item->sell_in <= 0) $item->quality --;
                    if($item->quality < 0) $item->quality = 0;
                    $item->sell_in --;
            }
        }
    }
}
