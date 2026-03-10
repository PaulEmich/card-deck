<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;

test('card has identifier', function () {
    $card = new Card('ace-spades');

    expect($card->getIdentifier())->toBe('ace-spades');
});

test('cards with same identifier are equal', function () {
    $card1 = new Card('ace-spades');
    $card2 = new Card('ace-spades');

    expect($card1->equals($card2))->toBeTrue();
});

test('cards with different identifiers are not equal', function () {
    $card1 = new Card('ace-spades');
    $card2 = new Card('king-hearts');

    expect($card1->equals($card2))->toBeFalse();
});
