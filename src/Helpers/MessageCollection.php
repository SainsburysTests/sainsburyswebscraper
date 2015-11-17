<?php

/**
 * MessageCollection.php
 *
 *
 */

namespace sainsburyswebscraper\Helpers;

use sainsburyswebscraper\Abstracts\BaseCollection;

/**
 *
 * MessageCollection
 *
 */
class MessageCollection extends BaseCollection
{
    /**
     * Return an array representation of the object
     *
     * @return string
     */
    public function toArray()
    {
        $response = array();
        foreach ($this->getItems() as $message) {
            array_push($response, $message->toArray());
        }
        return $response;
    }

    /**
     * Add a message to the collection
     *
     * @param  Message $message
     * @return MessageCollection
     */
    public function addMessage(Message $message)
    {
        $this->pushItem($message);
        return $this;
    }

    /**
     * Get all messages
     *
     * @return MessageCollection
     */
    public function getMessages()
    {
        return $this->getItems();
    }

    /**
     * Determinate if the collection messages of type DEBUG
     *
     * @return boolean
     */
    public function hasDebugMessages()
    {
        return $this->countbyPropertyValue('type', Message::TYPE_DEBUG) > 0 ? true : false;
    }

    /**
     * Determinate if the collection messages of type ERROR
     *
     * @return boolean
     */
    public function hasErrorMessages()
    {
        return $this->countbyPropertyValue('type', Message::TYPE_ERROR) > 0 ? true : false;
    }

    /**
     * Determinate if the collection messages of type FATAL
     *
     * @return boolean
     */
    public function hasFatalMessages()
    {
        return $this->countbyPropertyValue('type', Message::TYPE_FATAL) > 0 ? true : false;
    }

    /**
     * Determinate if the collection messages of type INFO
     *
     * @return boolean
     */
    public function hasInfoMessages()
    {
        return $this->countbyPropertyValue('type', Message::TYPE_INFO) > 0 ? true : false;
    }

    /**
     * Determinate if the collection messages of type WARNING
     *
     * @return boolean
     */
    public function hasWarningMessages()
    {
        return $this->countbyPropertyValue('type', Message::TYPE_WARN) > 0 ? true : false;
    }
}
