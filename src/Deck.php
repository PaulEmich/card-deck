<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

/**
 * @template T of Card
 */
class Deck
{
    /** @param T[] $cards */
    public function __construct(
        private array $cards = [],
    ) {}

    /** @return T[] */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function count(): int
    {
        return count($this->cards);
    }

    /** @return T|null */
    public function draw(): ?Card
    {
        return array_shift($this->cards);
    }

    public function isEmpty(): bool
    {
        return $this->cards === [];
    }
}
