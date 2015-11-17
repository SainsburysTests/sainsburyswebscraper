<?php

/**
 * ProductOverviewCommand.php
 *
 */
namespace sainsburyswebscraper\commands;

use sainsburyswebscraper\Abstracts\BaseCommand;
use sainsburyswebscraper\ProductScraper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 * ProductOverviewCommand.php
 *
 * @package SainsburysWebScraper
 *
 */
class ProductOverviewCommand extends BaseCommand
{

    /**
     * The command description
     *
     * @var string
     */
    protected $description = 'Scrape Sainsbury\'s grocery page and display an overview of all products.';

    /**
     * The command name
     *
     * @var string
     */
    protected $name = 'products:displayOverview';

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->setName($this->name)
            ->setDescription($this->description)
            ->addArgument('url');
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        if (empty($url)) {
            return $output->writeln("<error>No url given. .....</error>");
        }

        $scraper  = new ProductScraper($url);
        $response = $scraper->scrape();

        if ($response->isValid()) {
            $output->writeln($response->toJson());
        } else {
            $output->writeln("<error>Error: " . $response->getCode() . "</error>");
        }
    }
}
