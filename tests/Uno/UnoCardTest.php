<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Uno\Color;
use PaulEmich\CardDeck\Uno\UnoCard;
use PaulEmich\CardDeck\Uno\UnoCardType;

it('has color and number for number cards', function () {
    $card = new UnoCard(UnoCardType::Number, Color::Red, 5);

    expect($card->getType())->toBe(UnoCardType::Number)
        ->and($card->getColor())->toBe(Color::Red)
        ->and($card->getNumber())->toBe(5)
        ->and($card->getIdentifier())->toBe('red-5');
});

it('has color and type for action cards', function () {
    $card = new UnoCard(UnoCardType::Skip, Color::Blue);

    expect($card->getType())->toBe(UnoCardType::Skip)
        ->and($card->getColor())->toBe(Color::Blue)
        ->and($card->getIdentifier())->toBe('blue-skip');
});

it('has no color for wild cards', function () {
    $card = new UnoCard(UnoCardType::Wild);

    expect($card->getColor())->toBeNull()
        ->and($card->isWild())->toBeTrue()
        ->and($card->getIdentifier())->toBe('wild');
});

it('recognizes wild draw four as wild', function () {
    $card = new UnoCard(UnoCardType::WildDrawFour);

    expect($card->isWild())->toBeTrue()
        ->and($card->getIdentifier())->toBe('wild-draw-four');
});

it('does not consider regular cards as wild', function () {
    $number = new UnoCard(UnoCardType::Number, Color::Green, 3);
    $skip = new UnoCard(UnoCardType::Skip, Color::Yellow);

    expect($number->isWild())->toBeFalse()
        ->and($skip->isWild())->toBeFalse();
});
