<?php

declare(strict_types=1);

use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Standard\StandardDeckProvider;

it('has 52 cards', function () {
    $deck = DeckBuilder::standard()->build();

    expect($deck->count())->toBe(52);
});

it('can be multiplied with times parameter', function () {
    $deck = DeckBuilder::standard(times: 6)->build();

    expect($deck->count())->toBe(312);
});

it('can be added multiple times via withDeck', function () {
    $deck = (new DeckBuilder())
        ->withDeck(new StandardDeckProvider(), times: 2)
        ->build();

    expect($deck->count())->toBe(104);
});
