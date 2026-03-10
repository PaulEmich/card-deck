<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

interface DeckProvider
{
    /** @return Card[] */
    public function getCards(): array;
}
