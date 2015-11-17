<?php

/**
 * ProductScraper.php
 *
 */
namespace sainsburyswebscraper;

use sainsburyswebscraper\Abstracts\BaseScraper;
use sainsburyswebscraper\Models\Mappers\ProductMapper;
use sainsburyswebscraper\Models\Product;
use sainsburyswebscraper\Models\ProductCollection;
use Symfony\Component\DomCrawler\Crawler;
use sainsburyswebscraper\Helpers\ServiceResponse;

/**
 *
 * Scraper
 *
 */
class ProductScraper extends BaseScraper
{

    /**
     * (non-PHPdoc)
    */
    public function scrape()
    {
        $crawler = $this->request($this->url);

        if ($crawler instanceof Crawler) {
            $products = new ProductCollection();

            $crawler->filter(ProductCollection::CSS_SELECTOR)->each(
                function (Crawler $node) use ($products) {
                    $productLink = trim($node->filter(Product::CSS_SELECTOR)->text());
                    $productLink = $node->selectLink($productLink)->link();
                    $productNode = $this->client->click($productLink);

                    $products->pushItem(ProductMapper::populate($productNode));
                }
            );

            return ServiceResponse::success($products);
        }

        return ServiceResponse::failure('Something went wrong. We could\'n read from the given url.');
    }
}
