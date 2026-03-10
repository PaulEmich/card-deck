<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;

it('has an identifier', function () {
    $card = new Card('ace-spades');

    expect($card->getIdentifier())->toBe('ace-spades');
});

it('equals another card with the same identifier', function () {
    $card1 = new Card('ace-spades');
    $card2 = new Card('ace-spades');

    expect($card1->equals($card2))->toBeTrue();
});

it('does not equal a card with a different identifier', function () {
    $card1 = new Card('ace-spades');
    $card2 = new Card('king-hearts');

    expect($card1->equals($card2))->toBeFalse();
});
