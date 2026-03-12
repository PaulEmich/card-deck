<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Shuffler\CutShuffler;
use PaulEmich\CardDeck\Shuffler\OverhandShuffler;
use PaulEmich\CardDeck\Shuffler\RandomShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;

it('RandomShuffler preserves all cards', function () {
    $cards = array_map(fn($i) => new Card((string) $i), range(1, 52));

    $result = (new RandomShuffler())->shuffle($cards);

    expect($result)->toHaveCount(52);
});

it('RiffleShuffler preserves all cards', function () {
    $cards = array_map(fn($i) => new Card((string) $i), range(1, 52));

    $result = (new RiffleShuffler())->shuffle($cards);

    expect($result)->toHaveCount(52);
});

it('CutShuffler preserves all cards', function () {
    $cards = array_map(fn($i) => new Card((string) $i), range(1, 52));

    $result = (new CutShuffler())->shuffle($cards);

    expect($result)->toHaveCount(52);
});

it('OverhandShuffler preserves all cards', function () {
    $cards = array_map(fn($i) => new Card((string) $i), range(1, 52));

    $result = (new OverhandShuffler())->shuffle($cards);

    expect($result)->toHaveCount(52);
});

it('CutShuffler handles small decks', function () {
    $cards = [new Card('1')];

    $result = (new CutShuffler())->shuffle($cards);

    expect($result)->toHaveCount(1);
});

it('RiffleShuffler handles small decks', function () {
    $cards = [new Card('1')];

    $result = (new RiffleShuffler())->shuffle($cards);

    expect($result)->toHaveCount(1);
});
