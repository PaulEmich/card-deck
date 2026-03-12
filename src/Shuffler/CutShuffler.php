<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Shuffler;

use PaulEmich\CardDeck\Card;

class CutShuffler implements Shuffler
{
    /**
     * @param Card[] $cards
     * @return Card[]
     */
    public function shuffle(array $cards): array
    {
        $count = count($cards);

        if ($count < 2) {
            return $cards;
        }

        $cut = random_int(1, $count - 1);

        return [
            ...array_slice($cards, $cut),
            ...array_slice($cards, 0, $cut),
        ];
    }
}
