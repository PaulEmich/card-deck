<?php

declare(strict_types=1);

use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Shuffler\CutShuffler;
use PaulEmich\CardDeck\Shuffler\RandomShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;
use PaulEmich\CardDeck\Shuffler\ShuffleChain;

it('can shuffle a deck', function () {
    $deck = DeckBuilder::standard()
        ->shuffle(new RandomShuffler())
        ->build();

    expect($deck->count())->toBe(52);
});

it('can chain shuffle methods', function () {
    $deck = DeckBuilder::standard()
        ->shuffle(new CutShuffler())
        ->shuffle(new RiffleShuffler())
        ->shuffle(new CutShuffler())
        ->build();

    expect($deck->count())->toBe(52);
});

it('can use ShuffleChain with repeat', function () {
    $deck = DeckBuilder::standard()
        ->shuffle(
            ShuffleChain::create([new CutShuffler(), new RiffleShuffler(), new CutShuffler()])
                ->repeat(10),
        )
        ->build();

    expect($deck->count())->toBe(52);
});
