<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Shuffler;

use PaulEmich\CardDeck\Card;

class RandomShuffler implements Shuffler
{
    /**
     * @param Card[] $cards
     * @return Card[]
     */
    public function shuffle(array $cards): array
    {
        shuffle($cards);

        return $cards;
    }
}
