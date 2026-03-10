<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

/**
 * @template T of Card
 */
interface DeckProvider
{
    /** @return T[] */
    public function getCards(): array;
}
