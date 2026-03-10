<?php

declare(strict_types=1);

use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Uno\UnoDeckProvider;

it('has 108 cards', function () {
    $deck = DeckBuilder::withUno()->build();

    expect($deck->count())->toBe(108);
});

it('can be multiplied with times parameter', function () {
    $deck = DeckBuilder::withUno(times: 2)->build();

    expect($deck->count())->toBe(216);
});

it('can be added multiple times via withDeck', function () {
    $deck = (new DeckBuilder())
        ->withDeck(new UnoDeckProvider(), times: 2)
        ->build();

    expect($deck->count())->toBe(216);
});
