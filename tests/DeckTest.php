<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Deck;

it('can be created with cards', function () {
    $cards = [
        new Card('ace-spades'),
        new Card('king-hearts'),
    ];

    $deck = new Deck($cards);

    expect($deck->count())->toBe(2);
});

it('can be created empty', function () {
    $deck = new Deck();

    expect($deck->count())->toBe(0)
        ->and($deck->isEmpty())->toBeTrue();
});

it('draws the first card and removes it', function () {
    $deck = new Deck([
        new Card('ace-spades'),
        new Card('king-hearts'),
    ]);

    $card = $deck->draw();

    expect($card->getIdentifier())->toBe('ace-spades')
        ->and($deck->count())->toBe(1);
});

it('returns null when drawing from an empty deck', function () {
    $deck = new Deck();

    expect($deck->draw())->toBeNull();
});

it('is not empty when it has cards', function () {
    $deck = new Deck([new Card('ace-spades')]);

    expect($deck->isEmpty())->toBeFalse();
});

it('returns all cards', function () {
    $cards = [
        new Card('ace-spades'),
        new Card('king-hearts'),
    ];

    $deck = new Deck($cards);

    expect($deck->getCards())->toHaveCount(2);
});
