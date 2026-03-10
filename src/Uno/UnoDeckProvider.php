<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Uno;

use PaulEmich\CardDeck\DeckProvider;

/**
 * @implements DeckProvider<UnoCard>
 */
class UnoDeckProvider implements DeckProvider
{
    /** @return UnoCard[] */
    public function getCards(): array
    {
        $cards = [];

        foreach (Color::cases() as $color) {
            $cards[] = new UnoCard(UnoCardType::Number, $color, 0);

            for ($i = 1; $i <= 9; $i++) {
                $cards[] = new UnoCard(UnoCardType::Number, $color, $i);
                $cards[] = new UnoCard(UnoCardType::Number, $color, $i);
            }

            $cards[] = new UnoCard(UnoCardType::Skip, $color);
            $cards[] = new UnoCard(UnoCardType::Skip, $color);
            $cards[] = new UnoCard(UnoCardType::Reverse, $color);
            $cards[] = new UnoCard(UnoCardType::Reverse, $color);
            $cards[] = new UnoCard(UnoCardType::DrawTwo, $color);
            $cards[] = new UnoCard(UnoCardType::DrawTwo, $color);
        }

        for ($i = 0; $i < 4; $i++) {
            $cards[] = new UnoCard(UnoCardType::Wild);
            $cards[] = new UnoCard(UnoCardType::WildDrawFour);
        }

        return $cards;
    }
}
