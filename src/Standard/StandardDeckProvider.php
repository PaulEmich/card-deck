<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Standard;

use PaulEmich\CardDeck\DeckProvider;

/**
 * @implements DeckProvider<StandardCard>
 */
class StandardDeckProvider implements DeckProvider
{
    /** @return StandardCard[] */
    public function getCards(): array
    {
        $cards = [];

        foreach (Suit::cases() as $suit) {
            foreach (Rank::cases() as $rank) {
                $cards[] = new StandardCard($suit, $rank);
            }
        }

        return $cards;
    }
}
