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

        $chunks = [];

        while ($cards !== []) {
            $chunks[] = array_splice($cards, 0, random_int(1, min(5, count($cards))));
        }

        return array_merge(...array_reverse($chunks));
    }
}
