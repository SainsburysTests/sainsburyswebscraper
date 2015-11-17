<?php

/**
 * BaseScraper.php
 *
 */
namespace sainsburyswebscraper\Abstracts;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * BaseScraper
 *
 * @package sainsburyswebscraper
 */
abstract class BaseScraper
{

    /**
     *
     * @var Client
     */
    protected $client;

    /**
     *
     * @var string
     */
    protected $url;

    /**
     *
     * @var string
     */
    const METHOD_GET = 'GET';

    /**
     *
     * @param  string $url
     */
    public function __construct($url)
    {
        if ($this->client == null) {
            $this->client = new Client();
        }

        $this->url = $url;
        return $this;
    }

    /**
     * Scrape products from a given url
     *
     * @return sainsburyswebscraper\Helpers\ServiceResponse
     */
    abstract public function scrape();

    /**
     * Send the request
     *
     * @param  string $url
     * @param  string $method
     * @return mixed  (Symfony\Component\DomCrawler\Crawler|null)
     */
    public function request($url, $method = self::METHOD_GET)
    {
        $response = $this->client->request($method, $url);

        return $response instanceof Crawler ? $response : null;
    }
}
