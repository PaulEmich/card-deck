<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Deck;
use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Standard\StandardDeckProvider;
use PaulEmich\CardDeck\Uno\UnoDeckProvider;

it('creates an empty deck by default', function () {
    $deck = (new DeckBuilder())->build();

    expect($deck)->toBeInstanceOf(Deck::class)
        ->and($deck->isEmpty())->toBeTrue();
});

it('can add a single card', function () {
    $deck = (new DeckBuilder())
        ->addCard(new Card('ace-spades'))
        ->build();

    expect($deck->count())->toBe(1);
});

it('can add multiple cards', function () {
    $deck = (new DeckBuilder())
        ->addCards([
            new Card('ace-spades'),
            new Card('king-hearts'),
            new Card('queen-diamonds'),
        ])
        ->build();

    expect($deck->count())->toBe(3);
});

it('can be reset', function () {
    $builder = new DeckBuilder();
    $builder->addCard(new Card('ace-spades'));
    $builder->reset();

    $deck = $builder->build();

    expect($deck->isEmpty())->toBeTrue();
});

it('is fluent', function () {
    $builder = new DeckBuilder();

    expect($builder->addCard(new Card('ace-spades')))->toBe($builder)
        ->and($builder->addCards([new Card('king-hearts')]))->toBe($builder)
        ->and($builder->reset())->toBe($builder);
});

it('accepts a closure in withDeck', function () {
    $deck = (new DeckBuilder())
        ->withDeck(function (DeckBuilder $builder) {
            $builder->addCard(new Card('custom-1'));
            $builder->addCard(new Card('custom-2'));
        })
        ->build();

    expect($deck->count())->toBe(2);
});

it('supports times parameter with closure', function () {
    $deck = (new DeckBuilder())
        ->withDeck(function (DeckBuilder $builder) {
            $builder->addCard(new Card('joker'));
        }, times: 4)
        ->build();

    expect($deck->count())->toBe(4);
});

it('can mix different deck types', function () {
    $deck = (new DeckBuilder())
        ->withDeck(new StandardDeckProvider())
        ->withDeck(new UnoDeckProvider())
        ->build();

    expect($deck->count())->toBe(160);
});

it('can mix different deck types with different times', function () {
    $deck = (new DeckBuilder())
        ->withDeck(new StandardDeckProvider(), times: 2)
        ->withDeck(new UnoDeckProvider(), times: 1)
        ->build();

    expect($deck->count())->toBe(212);
});
