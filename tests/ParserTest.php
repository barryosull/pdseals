<?php

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

        $deals = $parser->parse($html);

        var_dump($deals);
    }
}