<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Uno;

enum UnoCardType: string
{
    case Number = 'number';
    case Skip = 'skip';
    case Reverse = 'reverse';
    case DrawTwo = 'draw-two';
    case Wild = 'wild';
    case WildDrawFour = 'wild-draw-four';
}
