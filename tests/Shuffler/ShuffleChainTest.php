<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Shuffler\CutShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;
use PaulEmich\CardDeck\Shuffler\ShuffleChain;
use PaulEmich\CardDeck\Shuffler\Shuffler;

it('applies shufflers in sequence', function () {
    $cards = array_map(fn ($i) => new Card((string) $i), range(1, 52));

    $chain = ShuffleChain::create([new CutShuffler(), new RiffleShuffler()]);
    $result = $chain->shuffle($cards);

    $sortedIds = fn (array $c) => array_map(fn (Card $card) => $card->getIdentifier(), $c);
    $original = $sortedIds($cards);
    $returned = $sortedIds($result);
    sort($original);
    sort($returned);

    expect($result)->toHaveCount(52)
        ->and($returned)->toBe($original);
});

it('repeats the entire chain', function () {
    $counter = new class implements Shuffler {
        public int $count = 0;

        public function shuffle(array $cards): array
        {
            $this->count++;

            return $cards;
        }
    };

    ShuffleChain::create([$counter])->repeat(5)->shuffle([new Card('1')]);

    expect($counter->count)->toBe(5);
});
