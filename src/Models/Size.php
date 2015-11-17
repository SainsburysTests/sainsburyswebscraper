<?php

/**
 * Size.php
 *
 */
namespace sainsburyswebscraper\Models;

use sainsburyswebscraper\Abstracts\BaseModel;
use sainsburyswebscraper\Helpers\Utils;

/**
 *
 * Size
 *
 */
class Size extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $bytes;

    /**
     * (non-PHPdoc)
     */
    public function toArray()
    {
        return array(
            Utils::formatBytes($this->bytes, 2)
        );
    }
}
