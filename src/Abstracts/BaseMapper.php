<?php

/**
 * BaseMapper.php
 */
namespace sainsburyswebscraper\Abstracts;

use sainsburyswebscraper\Interfaces\MapperContract;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * BaseMapper
 *
 */
abstract class BaseMapper implements MapperContract
{
    /**
     * Cast type map
     *
     * @var array
     */
    protected static $castTypeMap = array(
        self::CAST_TYPE_BOOLEAN => 'boolean',
        self::CAST_TYPE_INTEGER => 'integer',
        self::CAST_TYPE_FLOAT   => 'float',
        self::CAST_TYPE_STRING  => 'string',
        self::CAST_TYPE_ARRAY   => 'array',
        self::CAST_TYPE_OBJECT  => 'object',
        self::CAST_TYPE_NULL    => 'null'
    );

    // Cast type constants
    const CAST_TYPE_ARRAY   = 'array';
    const CAST_TYPE_BOOLEAN = 'boolean';
    const CAST_TYPE_FLOAT   = 'float';
    const CAST_TYPE_INTEGER = 'integer';
    const CAST_TYPE_NULL    = 'null';
    const CAST_TYPE_OBJECT  = 'object';
    const CAST_TYPE_STRING  = 'string';

    /**
     * Private constructor to prevent creating a new instance of the
     * Singleton via the `new` operator from outside of this class.
     *
     */
    private function __construct()
    {
    }

    /**
     * Set the type of a variable
     *
     * @param  mixed   $var
     * @param  string  $type
     * @return boolean
     */
    private static function castVariable(&$var, $type)
    {
        if (self::isCastable($type)) {
            return settype($var, $type);
        }
        return false;
    }

    /**
     * Fill the model with an array of attributes
     *
     * @param  object $instance
     * @param  array  $attributes
     * @return mixed  (object|null)
     */
    protected static function fill(BaseModel $instance, array $attributes)
    {
        foreach ($attributes as $key => $attribute) {
            if (property_exists($instance, $key)) {
                $instance->$key = $attribute;
            }
        }
        return $instance;
    }

    /**
     * Returns the namespace of the object the mapper corresponds to
     *
     * @return string
     */
    public static function getModelNamespace()
    {
        return self::create(false);
    }

    /**
     * Get a value
     *
     * @param  Crawler $node
     * @param  string  $selector
     * @param  mixed   $default
     * @param  mixed   $cast
     * @return mixed
     */
    public static function getValue(&$node, $selector, $default = null, $cast = false)
    {
        $var = trim($node->filter($selector)->text());
        if (!empty($var)) {
            if ($cast != false) {
                self::castVariable($var, $cast);
            }
            return $var;
        } else {
            return $default != null ? $default : null;
        }
    }

    /**
     * Determine if a given type is castable
     *
     * @param  string $type
     * @return boolean
     */
    public static function isCastable($type)
    {
        return isset(self::$castTypeMap[$type]) ? true : false;
    }
}
