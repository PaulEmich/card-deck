<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Deck;

it('can be created with cards', function () {
    $deck = new Deck([new Card('ace-spades'), new Card('king-hearts')]);

    expect($deck->count())->toBe(2);
});

it('can be created empty', function () {
    $deck = new Deck();

    expect($deck->count())->toBe(0)
        ->and($deck->isEmpty())->toBeTrue();
});

it('returns all cards in order', function () {
    $cards = [new Card('ace-spades'), new Card('king-hearts')];

    $returned = (new Deck($cards))->getCards();

    expect($returned[0]->getIdentifier())->toBe('ace-spades')
        ->and($returned[1]->getIdentifier())->toBe('king-hearts');
});

it('draws cards in order', function () {
    $deck = new Deck([new Card('ace-spades'), new Card('king-hearts')]);

    expect($deck->draw()->getIdentifier())->toBe('ace-spades')
        ->and($deck->draw()->getIdentifier())->toBe('king-hearts')
        ->and($deck->count())->toBe(0);
});

it('returns null when drawing from an empty deck', function () {
    expect((new Deck())->draw())->toBeNull();
});

it('is not empty when it has cards', function () {
    expect((new Deck([new Card('ace-spades')]))->isEmpty())->toBeFalse();
});
