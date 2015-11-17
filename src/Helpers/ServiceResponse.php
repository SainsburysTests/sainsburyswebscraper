<?php

/**
 * ServiceResponse.php
 *
 */
namespace sainsburyswebscraper\Helpers;

use sainsburyswebscraper\Abstracts\BaseModel;
use sainsburyswebscraper\Interfaces\Arrayable;
use sainsburyswebscraper\Interfaces\Jsonable;

/**
 *
 * ServiceResponse
 * @package SainsburysWebScraper
 */
class ServiceResponse extends BaseModel implements Arrayable, Jsonable
{
    // Status constants
    const STATUS_FAILURE = 'failure';
    const STATUS_SUCCESS = 'success';

    /**
     * Response data
     *
     * @var mixed
     */
    protected $body;

    /**
     * Response code
     *
     * @var string
     */
    protected $code;

    /**
     * Response messages
     *
     * @var MessageCollection
     */
    protected $messages;

    /**
     *
     * @param  string $code
     * @param  string $body
     * @param  mixed  $messages
     */
    public function __construct($code = null, $body = null, $messages = null)
    {
        $this->code     = $code;
        $this->body     = $body;
        $this->messages = $messages;
        return $this;
    }

    /**
     * Add a message to the reponse
     *
     * @param mixed $message
     * @return Response
     */
    public function addMessage(Message $message)
    {
        if ($this->messages === null) {
            $this->messages = new MessageCollection();
        }

        $this->messages->addMessage($message);

        return $this;
    }

    /**
     * Compose a new message
     *
     * @param  string $content
     * @param  string $type
     * @return Message
     */
    public static function composeMessage($content, $type = Message::TYPE_INFO)
    {
        $message = new Message();
        return $message->setContent($content)->setType($type);
    }

    /**
     * Create a failure response
     *
     * @param  string $message
     * @return ServiceResponse
     */
    public static function failure($message, $messageType = Message::TYPE_ERROR)
    {
        $instance = new self();
        return $instance->setCode(self::STATUS_FAILURE)->addMessage(self::composeMessage($message, $messageType));
    }

    /**
     * Get the response's data
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Return the response code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the internal messages store
     *
     * @return MessageCollection
     *
     */
    public function getMessages()
    {
        if ($this->messages == null) {
            $this->messages = new MessageCollection();
        }

        return $this->messages;
    }

    /**
     * Check if the response has any error messages (of any error)
     *
     * @return bool
     */
    public function hasErrorMessages()
    {
        return $this->messages->hasErrorMessages();
    }

    /**
     * Check if the response has any messages (of any kind)
     *
     * @return bool
     */
    public function hasMessages()
    {
        return $this->messages->isEmpty();
    }

    /**
     * Check whether the response is a success
     *
     * @return boolean
     */
    public function isValid()
    {
        return ($this->code === self::STATUS_SUCCESS) ? true : false;
    }

    /**
     * Set the response's data
     *
     * @param  mixed $data
     * @return ServiceResponse
     */
    public function setBody($data)
    {
        $this->body = $data;
        return $this;
    }

    /**
     * Set the response code
     *
     * @param  string $code
     * @return ServiceResponse
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Create a success response
     *
     * @param  mixed  $body
     * @param  string $message
     * @return ServiceResponse
     */
    public static function success($body, $message = null, $messageType = Message::TYPE_INFO)
    {
        $instance = new self();
        $instance->setCode(self::STATUS_SUCCESS)->setBody($body);

        // Add message
        if ($message !== null) {
            $instance->addMessage(self::composeMessage($message, $messageType));
        }

        return $instance;
    }


    /**
     * (non-PHPdoc)
     */
    public function toArray()
    {
        $body = $this->getBody() instanceof Arrayable ?
                $this->getBody()->toArray()           :
                null;

        return array(
            'body'     => $body,
            'code'     => $this->getCode(),
            'messages' => $this->getMessages()->toArray()
        );
    }

    /**
     * (non-PHPdoc)
     */
    public function toJson($options = 0)
    {
        try {
            return json_encode($this->toArray(), JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
