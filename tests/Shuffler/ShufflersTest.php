<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Shuffler\CutShuffler;
use PaulEmich\CardDeck\Shuffler\OverhandShuffler;
use PaulEmich\CardDeck\Shuffler\RandomShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;
use PaulEmich\CardDeck\Shuffler\Shuffler;

dataset('shufflers', [
    'Random'   => fn () => new RandomShuffler(),
    'Riffle'   => fn () => new RiffleShuffler(),
    'Cut'      => fn () => new CutShuffler(),
    'Overhand' => fn () => new OverhandShuffler(),
]);

it('preserves all cards', function (Shuffler $shuffler) {
    $cards = array_map(fn ($i) => new Card((string) $i), range(1, 52));
    $result = $shuffler->shuffle($cards);

    $sortedIds = function (array $cards): array {
        $ids = array_map(fn (Card $c) => $c->getIdentifier(), $cards);
        sort($ids);

        return $ids;
    };

    expect($result)->toHaveCount(52)
        ->and($sortedIds($result))->toBe($sortedIds($cards));
})->with('shufflers');

it('returns a single card unchanged', function (Shuffler $shuffler) {
    $result = $shuffler->shuffle([new Card('only-card')]);

    expect($result)->toHaveCount(1)
        ->and($result[0]->getIdentifier())->toBe('only-card');
})->with('shufflers');
