<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Standard;

use PaulEmich\CardDeck\Card;

class StandardCard extends Card
{
    public function __construct(
        private readonly Suit $suit,
        private readonly Rank $rank,
    ) {
        parent::__construct($this->rank->value . '-' . $this->suit->value);
    }

    public function getSuit(): Suit
    {
        return $this->suit;
    }

    public function getRank(): Rank
    {
        return $this->rank;
    }
}
