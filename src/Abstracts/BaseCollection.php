<?php

/**
 * BaseCollection.php
 *
 *
 */
namespace sainsburyswebscraper\Abstracts;

use sainsburyswebscraper\Interfaces\Jsonable;
use sainsburyswebscraper\Interfaces\Arrayable;

/**
 *
 * BaseCollection
 *
 */
abstract class BaseCollection implements Arrayable, Jsonable
{

    /**
     *
     * @var array
     */
    protected $items = array();

    /**
     * Get the item count
     *
     * @return integer
     */
    public function count()
    {
        return count($this->getItems());
    }

    /**
     * Count items by proberty value
     *
     * @param string $propertyName
     * @param string $value
     * @return integer
     */
    public function countbyPropertyValue($propertyName, $value)
    {
        $count = 0;
        if ($this->isEmpty()) {
            return $count;
        }

        foreach ($this->getItems() as $item) {
            if ($item->__get($propertyName) == $value) {
                $count ++;
            }
        }
        return $count;
    }

    /**
     * Get an item from the collection by its position
     *
     * @param  integer $position
     * @return mixed
     */
    public function getItem($position)
    {
        return isset($this->items[$position]) ? $this->items[$position] : null;
    }

    /**
     * Checks if the collection is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->count() == 0 ? true : false;
    }

    /**
     * Push an item to the collection
     *
     * @param  mixed $item
     * @return BaseCollection
     */
    public function pushItem($item)
    {
        array_push($this->items, $item);
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * (non-PHPdoc)
     */
    public function toArray()
    {
        return array_map(
            function ($value) {
                return $value instanceof Arrayable ? $value->toArray() : array();
            },
            $this->getItems()
        );
    }

    /**
     * (non-PHPdoc)
     */
    public function toJson()
    {
        try {
            return json_encode($this->toArray(), JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            throw new Exception($e);
        }
    }
}
