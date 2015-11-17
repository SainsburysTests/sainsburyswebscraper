<?php

/**
 * Jsonable.php
 *
 */
namespace sainsburyswebscraper\Interfaces;

/**
 *
 * Jsonable
 *
 */
interface Jsonable
{

    /**
     * Convert object into a JSON object
     *
     * @return string
     */
    public function toJson();
}
