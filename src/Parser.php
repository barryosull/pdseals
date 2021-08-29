<?php declare(strict_types=1);

namespace Barryosull\PSDeals;

use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    /**
     * @param string $html
     * @return Game[]
     */
    public function parseFullGames(string $html): array
    {
        $items = self::getItemsFromPage($html);

        return self::makeGamesFromItems($items);
    }

    private static function getItemsFromPage(string $html): \stdClass
    {
        $crawler = new Crawler($html);

        $jsonNode = $crawler->filter('#__NEXT_DATA__');

        $json = $jsonNode->text();

        $object =  json_decode($json, false);

        return $object->props->apolloState;
    }

    /**
     * @param \stdClass $items
     * @return array
     */
    private static function makeGamesFromItems(\stdClass $items): array
    {
        $games = [];

        foreach ($items as $key => $item) {
            if (self::isGame($key, $item)) {
                $games[] = new Game(
                    $item->name,
                    self::getPrice($item, $items)
                );
            }
        }

        return $games;
    }

    private static function isGame(string $key, \stdClass $value): bool
    {
        $isProduct = strpos($key, 'Product:') === 0;
        $hasName = isset($value->name);
        $hasDisplayClassification = isset($value->localizedStoreDisplayClassification);
        if (!$isProduct || !$hasName || !$hasDisplayClassification) {
            return false;
        }
        $gameClassifications = ['Full Game', 'Premium Edition'];
        return in_array($value->localizedStoreDisplayClassification, $gameClassifications);
    }

    private static function getPrice(\stdClass $item, \stdClass $items): string {
        $priceKey = $item->price->id;

        $priceOjb = $items->{$priceKey};

        return $priceOjb->discountedPrice;
    }
}
