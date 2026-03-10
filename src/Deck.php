<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

class Deck
{
    /** @param Card[] $cards */
    public function __construct(
        private array $cards = [],
    ) {}

    /** @return Card[] */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function count(): int
    {
        return count($this->cards);
    }

    public function draw(): ?Card
    {
        return array_shift($this->cards);
    }

    public function isEmpty(): bool
    {
        return $this->cards === [];
    }
}
