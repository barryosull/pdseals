<?php declare(strict_types=1);

namespace Barryosull\PSDealsTest;

use Barryosull\PSDeals\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @test
     */
    public function parse_deals_from_page()
    {
        $html = file_get_contents(__DIR__ . '/fixtures/deals-p1.html');

        $parser = new Parser();

        $games = $parser->parseFullGames($html);

        $this->assertEquals($gameCount = 22, count($games), "Missing games from list");

        var_dump($games);
    }
}