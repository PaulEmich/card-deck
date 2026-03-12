<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Shuffler;

use PaulEmich\CardDeck\Card;

class OverhandShuffler implements Shuffler
{
    /**
     * @param Card[] $cards
     * @return Card[]
     */
    public function shuffle(array $cards): array
    {
        if (count($cards) < 2) {
            return $cards;
        }

        $result = [];

        while ($cards !== []) {
            $chunk = array_splice($cards, 0, random_int(1, min(5, count($cards))));
            $result = [...$chunk, ...$result];
        }

        return $result;
    }
}
