<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Deck;

test('deck can be created with cards', function () {
    $cards = [
        new Card('ace-spades'),
        new Card('king-hearts'),
    ];

    $deck = new Deck($cards);

    expect($deck->count())->toBe(2);
});

test('deck can be created empty', function () {
    $deck = new Deck();

    expect($deck->count())->toBe(0);
    expect($deck->isEmpty())->toBeTrue();
});

test('draw returns first card and removes it', function () {
    $deck = new Deck([
        new Card('ace-spades'),
        new Card('king-hearts'),
    ]);

    $card = $deck->draw();

    expect($card->getIdentifier())->toBe('ace-spades');
    expect($deck->count())->toBe(1);
});

test('draw returns null when deck is empty', function () {
    $deck = new Deck();

    expect($deck->draw())->toBeNull();
});

test('isEmpty returns false when deck has cards', function () {
    $deck = new Deck([new Card('ace-spades')]);

    expect($deck->isEmpty())->toBeFalse();
});

test('getCards returns all cards', function () {
    $cards = [
        new Card('ace-spades'),
        new Card('king-hearts'),
    ];

    $deck = new Deck($cards);

    expect($deck->getCards())->toHaveCount(2);
});
