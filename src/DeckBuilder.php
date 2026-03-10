<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

class DeckBuilder
{
    /** @var Card[] */
    private array $cards = [];

    public function addCard(Card $card): self
    {
        $this->cards[] = $card;

        return $this;
    }

    /** @param Card[] $cards */
    public function addCards(array $cards): self
    {
        foreach ($cards as $card) {
            $this->addCard($card);
        }

        return $this;
    }

    public function build(): Deck
    {
        return new Deck($this->cards);
    }

    public function reset(): self
    {
        $this->cards = [];

        return $this;
    }
}
