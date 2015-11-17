<?php

/**
 * BaseModel.php
 *
 */
namespace sainsburyswebscraper\Abstracts;

use sainsburyswebscraper\Interfaces\Arrayable;
use sainsburyswebscraper\Interfaces\Jsonable;

/**
 * BaseModel
 *
 */
abstract class BaseModel implements Arrayable, Jsonable
{

    /**
     * Magic getter
     *
     * @param  string $property
     * @return mixed
     */
    public function __get($property)
    {
        return property_exists($this, $property) ? $this->$property : null;
    }

    /**
     * Magic setter
     *
     * @param  string $parameter
     * @param  mixed  $value
     * @return object
     */
    public function __set($parameter, $value)
    {
        if (property_exists($this, $parameter)) {
            $this->$parameter = $value;
        }

        return $this;
    }

    /**
     * (non-PHPdoc)
     */
    public function toJson()
    {
        try {
            return json_encode($this->toArray());
        } catch (\Exception $e) {
            throw new Exception($e);
        }
    }
}
