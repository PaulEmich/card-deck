<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Shuffler;

use PaulEmich\CardDeck\Card;

class RiffleShuffler implements Shuffler
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

        $mid = intdiv($count + 1, 2);

        $left = array_slice($cards, 0, $mid);
        $right = array_slice($cards, $mid);

        $leftCount = $mid;
        $rightCount = $count - $mid;

        $leftIndex = 0;
        $rightIndex = 0;

        $result = [];

        while ($leftIndex < $leftCount || $rightIndex < $rightCount) {
            $takeLeft =
                $rightIndex >= $rightCount ||
                ($leftIndex < $leftCount && random_int(0, 1) === 0);

            if ($takeLeft) {
                $result[] = $left[$leftIndex];
                $leftIndex++;
            } else {
                $result[] = $right[$rightIndex];
                $rightIndex++;
            }
        }

        return $result;
    }
}
