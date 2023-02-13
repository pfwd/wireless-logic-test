<?php

namespace Console\App\Crawler;

use Symfony\Component\DomCrawler\Crawler;

class DOMCrawler
{

    /**
     * Returns the documents' crawler.
     * - Gets the contents of the website
     * - Returns a new instance of Crawler
     *
     * @param string $domain
     *
     * @return Crawler
     */
    public function getDocumentCrawler(string $domain): Crawler
    {
       $document = $this->loadDocument($domain);

        return $this->getCrawler($document);
    }

    public function getCrawler(string $document): Crawler
    {
        return new Crawler($document);
    }

    public function loadDocument(string $domain): string
    {
        $html = file_get_contents($domain);
        if (!$html) {
            $html = '';
        }

        return $html;
    }


    /**
     * Gets the discount string from the Crawler.
     * Returns '0' if a discount is not found.
     *
     * @param Crawler $crawler Document Crawler
     *
     * @return string
     */
    public function getDiscountFromCrawler(Crawler $crawler): string
    {
        $discount = '0';

        if ($crawler->filter('.package-price > p')->count() > 0) {
            $discount =  $crawler->filter('.package-price p')->text();
        }

        return $discount;
    }

    public function getTextFromNode(Crawler $node, string $selector): string
    {
        return $node->filter($selector)->text();
    }
}