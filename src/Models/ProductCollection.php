<?php

/**
 * ProductCollection.php
 *
 */
namespace sainsburyswebscraper\Models;

use sainsburyswebscraper\Abstracts\BaseCollection;
use sainsburyswebscraper\Interfaces\Arrayable;
use sainsburyswebscraper\Interfaces\Jsonable;

/**
 *
 * ProductCollection
 *
 * @package sainsburyswebscraper
 *
 */
class ProductCollection extends BaseCollection implements Arrayable, Jsonable
{
    /**
     *
     * @var string
     */
    const CSS_SELECTOR = '.productLister li .product';

    /**
     * Compute the total sum of all products within the collection
     *
     * @return float
     */
    public function sumProducts()
    {
        $sum = 0;
        foreach ($this->getItems() as $product) {
            $sum = $sum + $product->getUnitPrice()->getAmount();
        }

        return $sum;
    }

    /**
     * (non-PHPdoc)
     */
    public function toArray()
    {
        $items = array_map(
            function ($value) {
                return $value instanceof Arrayable ? $value->toArray() : array();
            },
            $this->getItems()
        );

        return array(
            'items' => $items,
            'stats' => array(
                'itemCount' => $this->count(),
                'itemSum' => $this->sumProducts()
            )
        );
    }
}
