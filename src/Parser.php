<?php declare(strict_types=1);

namespace Barryosull\PSDeals;

use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    public function parse(string $html): \stdClass
    {
        $crawler = new Crawler($html);

        $jsonNode = $crawler->filter('#__NEXT_DATA__');

        $json = $jsonNode->text();

        $object =  json_decode($json, false);

        return $object->props->apolloState;
    }
}
