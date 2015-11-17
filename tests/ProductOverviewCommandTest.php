<?php

/**
 * ProductOverviewCommandTest.php
 *
 */
use sainsburyswebscraper\Commands\ProductOverviewCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 *
 * ProductOverviewCommandTest.php
 *
 * @package package
 */
class ProductOverviewCommandTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test command execution with no given url
     *
     * @return void
     */
    public function testExecutionNoUrl()
    {
        $application = new Application();
        $application->add(new ProductOverviewCommand());

        $command = $application->find('products:displayOverview');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'      => $command->getName(),
            'url'          => null
        ));

        $this->assertRegExp('/No url given....../', $commandTester->getDisplay());
    }

    /**
     * Test command execution with a given url
     *
     * @return void
     */
    public function testExecutionSuccess()
    {
        $application = new Application();
        $application->add(new ProductOverviewCommand());

        $command = $application->find('products:displayOverview');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'      => $command->getName(),
            'url'          => 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/CategoryDisplay?listView=true&orderBy=FAVOURITES_FIRST&parent_category_rn=12518&top_category=12518&langId=44&beginIndex=0&pageSize=20&catalogId=10137&searchTerm=&categoryId=185749&listId=&storeId=10151&promotionId=#langId=44&storeId=10151&catalogId=10137&categoryId=185749&parent_category_rn=12518&top_category=12518&pageSize=20&orderBy=FAVOURITES_FIRST&searchTerm=&beginIndex=0&hideFilters=true'
        ));

        $this->assertRegExp('/"code": "success"/', $commandTester->getDisplay());
    }
}
