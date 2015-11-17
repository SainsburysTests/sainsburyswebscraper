<?php

/**
 * Product.php
 *
 */
namespace sainsburyswebscraper\Models;

use sainsburyswebscraper\Abstracts\BaseModel;

/**
 *
 * Product
 *
 * @package sainsburyswebscraper
 *
 */
class Product extends BaseModel
{
    /**
     *
     * @param string
     */
    const CSS_SELECTOR = '.productInner > .productInfoWrapper > .productInfo > h3 > a';

    /**
     * The product description
     *
     * @var string
     */
    protected $description;

    /**
     * The page size in kilobyte
     *
     * @var float
     */
    protected $size;

    /**
     * The product title
     *
     * @var string
     */
    protected $title;

    /**
     * The price per unit
     *
     * @var float
     */
    protected $unitPrice;

    /**
     * Get the product description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the page size
     *
     * @return Size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the product title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the price per unit
     *
     * @return UnitPrice
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * (non-PHPdoc)
     */
    public function toArray()
    {
        return array(
            'description' => $this->getDescription(),
            'size'        => array_values($this->getSize()->toArray())[0],
            'title'       => $this->getTitle(),
            'unitPrice'   => $this->getUnitPrice()->toArray(),
        );
    }
}
