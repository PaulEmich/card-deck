<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Standard;

enum Suit: string
{
    case Hearts = 'hearts';
    case Diamonds = 'diamonds';
    case Clubs = 'clubs';
    case Spades = 'spades';
}
