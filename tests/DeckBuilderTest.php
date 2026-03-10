<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Deck;
use PaulEmich\CardDeck\DeckBuilder;

test('builder creates empty deck by default', function () {
    $deck = (new DeckBuilder())->build();

    expect($deck)->toBeInstanceOf(Deck::class)
        ->and($deck->isEmpty())->toBeTrue();
});

test('builder can add single card', function () {
    $deck = (new DeckBuilder())
        ->addCard(new Card('ace-spades'))
        ->build();

    expect($deck->count())->toBe(1);
});

test('builder can add multiple cards', function () {
    $deck = (new DeckBuilder())
        ->addCards([
            new Card('ace-spades'),
            new Card('king-hearts'),
            new Card('queen-diamonds'),
        ])
        ->build();

    expect($deck->count())->toBe(3);
});

test('builder can be reset', function () {
    $builder = new DeckBuilder();
    $builder->addCard(new Card('ace-spades'));
    $builder->reset();

    $deck = $builder->build();

    expect($deck->isEmpty())->toBeTrue();
});

test('builder is fluent', function () {
    $builder = new DeckBuilder();

    expect($builder->addCard(new Card('ace-spades')))->toBe($builder)
        ->and($builder->addCards([new Card('king-hearts')]))->toBe($builder)
        ->and($builder->reset())->toBe($builder);
});
