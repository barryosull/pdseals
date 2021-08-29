<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Barryosull\PSDeals\Game;
use Barryosull\PSDeals\Parser;

if (!isset($argv[1])) {
    exit('Missing mandatory "dealsurl" argument, please add the URL of the deals page to parse');
}

$dealsPageUrl = $argv[1];
$games = makeGamesList($dealsPageUrl);

makeListViewPage($games);

echo "List with " . count($games) . " created\n";


/**
 * @return Game[]
 */
function makeGamesList(string $dealsPageUrl): array {
    $html = file_get_contents($dealsPageUrl);
    $parser = new Parser();
    return $parser->parseFullGames($html);
}

function makeListViewPage(array $games) {
    ob_start();
    require_once __DIR__ . '/../templates/list.php';
    $html = ob_get_clean();
    file_put_contents(__DIR__ . '/../../public/games.html', $html);
}