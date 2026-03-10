<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Standard;

enum Rank: string
{
    case Two = '2';
    case Three = '3';
    case Four = '4';
    case Five = '5';
    case Six = '6';
    case Seven = '7';
    case Eight = '8';
    case Nine = '9';
    case Ten = '10';
    case Jack = 'jack';
    case Queen = 'queen';
    case King = 'king';
    case Ace = 'ace';
}
