<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Standard\Rank;
use PaulEmich\CardDeck\Standard\StandardCard;
use PaulEmich\CardDeck\Standard\Suit;

it('has a suit and rank', function () {
    $card = new StandardCard(Suit::Spades, Rank::Ace);

    expect($card->getSuit())->toBe(Suit::Spades)
        ->and($card->getRank())->toBe(Rank::Ace);
});

it('combines rank and suit in the identifier', function () {
    $card = new StandardCard(Suit::Hearts, Rank::King);

    expect($card->getIdentifier())->toBe('king-hearts');
});
