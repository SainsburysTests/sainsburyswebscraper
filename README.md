# Sainsburys WebScraper

Console application which scrapes Sainsbury’s grocery page and returns a JSON representation of all products on the page.

## Installation

Using composer, add following to your composer.json file to have this repository automatically imported into your vendor's folder:

```json
{
    "require" : {
      "sainsburyswebscraper": "version_number"
    }
}
```
Then run `php composer.phar update` from the command line. Composer will install the sainsburyswebscraper package.

### Dependencies

- fabpot/goutte
- symfony/console
- symfony/dom-crawler

## How to use

## Examples

Have a look into the the `/tests/` directory for more examples.

```php

// Example usage: php App.php products:displayOverview 'url'
// E.g. Scrape the Sainsbury’s grocery page - Ripe Fruits
php src/App.php products:displayOverview 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/CategoryDisplay?listView=true&orderBy=FAVOURITES_FIRST&parent_category_rn=12518&top_category=12518&langId=44&beginIndex=0&pageSize=20&catalogId=10137&searchTerm=&categoryId=185749&listId=&storeId=10151&promotionId=#langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true'
```