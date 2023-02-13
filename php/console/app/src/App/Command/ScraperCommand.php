<?php
/**
 * Class for Scraper
 * Scraper command
 * php version 8.2
 *
 * @category Command
 * @file     ScraperCommand.php
 * @package  Wirelesslogictest
 * @author   Peter Fisher <hello@websomatic.co.uk>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     ''
 */
namespace Console\App\Command;

use Console\App\Crawler\DOMCrawler;
use Console\App\DataStore\Product;
use Console\App\Formatter\PriceFormatter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Scraper
 *
 * @category Command
 * @file     ScraperCommand.php
 * @package  Wirelesslogictest
 * @author   Peter Fisher <hello@websomatic.co.uk>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     ''
 */
class ScraperCommand extends Command
{

    public function __construct(
        private PriceFormatter $priceFormatter,
        private DOMCrawler $crawler,
        private Product $productModel,
        string $name = null)
    {
        parent::__construct($name);
    }

    /**
     * Configures the command
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('scraper')
            ->setDescription('scraps page')
            ->setHelp('');
    }

    /**
     * Executes the command
     *
     * @param InputInterface  $input  Command inputs
     * @param OutputInterface $output Command outputs
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Resetting up database');

        $this->productModel->dropTable('product');
        $this->productModel->createTable();

        $crawler = $this->crawler->getDocumentCrawler('https://wltest.dns-systems.net/');

        $output->writeln('Crawling site');
        $productDataSet = $crawler->filter('.package')->each(
            function (Crawler $node, $i) {

                $discount = $this->crawler->getDiscountFromCrawler($node);

                $heading = $this->crawler->getTextFromNode($node,'h3');
                $title = $this->crawler->getTextFromNode($node,'.package-name');
                $price = $this->crawler->getTextFromNode($node,'.price-big');
                $price = mb_substr($price, 1, strlen($price));
                $packagePriceText = $this->crawler->getTextFromNode($node,'.package-price');

                $priceInPennies = $this->priceFormatter->getPriceInPennies($price);

                $annualPrice = $this->priceFormatter->getAnnualPriceFromText(
                    $packagePriceText,
                    $priceInPennies
                );

                return [
                'id' => $i + 1,
                'heading' => $heading,
                'title' => $title,
                'price' => $price,
                'price_in_pence' => $priceInPennies,
                'annual_price' => $annualPrice,
                'discount' => $discount,
                ];
            }
        );

        foreach ($productDataSet as $productData) {
            $output->writeln('Saving data: ' . $productData['heading']);
            $this->productModel->insert($productData);

        }

        $output->writeln('Done');

        return Command::SUCCESS;
    }
}