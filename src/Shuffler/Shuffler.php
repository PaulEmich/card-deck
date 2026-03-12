<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Shuffler;

use PaulEmich\CardDeck\Card;

interface Shuffler
{
    /**
     * @param Card[] $cards
     * @return Card[]
     */
    public function shuffle(array $cards): array;
}
