<?php

/**
 * Message.php
 *
 */

namespace sainsburyswebscraper\Helpers;

use sainsburyswebscraper\Abstracts\BaseModel;

/**
 *
 * Message
 *
 */
class Message extends BaseModel
{
    /**
     * The DEBUG Level designates fine-grained informational events
     * that are most useful to debug an application.
     *
     * @var string
     */
    const TYPE_DEBUG = 'debug';

    /**
     * The ERROR level designates error events that might still
     * allow the application to continue running.
     *
     * @var string
     */
    const TYPE_ERROR = 'error';

    /**
     * The FATAL level designates very severe error events that
     * will presumably lead the application to abort.
     *
     * @var string
     */
    const TYPE_FATAL = 'fatal';

    /**
     * The INFO level designates informational messages that
     * highlight the progress of the application at coarse-grained level.
     *
     * @var string
     */
    const TYPE_INFO = 'info';

    /**
     * The WARN level designates potentially harmful situations.
     *
     * @var string
     */
    const TYPE_WARN = 'warn';

    /**
     * The message content
     *
     * @var string
     */
    protected $content;

    /**
     * The message type
     *
     * @var string
     */
    protected $type;

    /**
     * All available message types
     *
     * @var array
     */
    private static $types = array(
        self::TYPE_DEBUG => 'Debug',
        self::TYPE_ERROR => 'Error',
        self::TYPE_FATAL => 'Fatal',
        self::TYPE_INFO  => 'Info',
        self::TYPE_WARN  => 'Warning'
    );

    /**
     * Get the message type
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the message type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Check if the message is of type DEBUG
     *
     * @return boolean
     */
    public function isDebug()
    {
        return $this->type == self::TYPE_DEBUG ? true : false;
    }

    /**
     * Check if the message is of type ERROR
     *
     * @return boolean
     */
    public function isError()
    {
        return $this->type == self::TYPE_ERROR ? true : false;
    }

    /**
     * Check if the message is of type FATAL
     *
     * @return boolean
     */
    public function isFatal()
    {
        return $this->type == self::TYPE_FATAL ? true : false;
    }

    /**
     * Check if the message is of type INFO
     *
     * @return boolean
     */
    public function isInfo()
    {
        return $this->type == self::TYPE_INFO ? true : false;
    }

    /**
     * Check if the message is of type WARNING
     *
     * @return boolean
     */
    public function isWarning()
    {
        return $this->type == self::TYPE_WARN ? true : false;
    }

    /**
     * Set the content
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = is_string($content) ? $content : null;
        return $this;
    }

    /**
     * Set the type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = self::typeAllowed($type) ? $type : null;
        return $this;
    }

    /**
     * Return an array representation of the object
     *
     * @return string
     */
    public function toArray()
    {
        return array(
            'content' => $this->getContent(),
            'type'    => $this->getType()
        );
    }

    /**
     * Determines if the given type is an allowed message type
     *
     * @param  string $type
     * @return boolean
     */
    public static function typeAllowed($type)
    {
        return isset(self::$types[$type]) ? true : false;
    }
}
