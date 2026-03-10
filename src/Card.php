<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

class Card
{
    public function __construct(
        private readonly string $identifier,
    ) {}

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function equals(Card $other): bool
    {
        return $this->identifier === $other->identifier;
    }
}
