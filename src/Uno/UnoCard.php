<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Uno;

use PaulEmich\CardDeck\Card;

class UnoCard extends Card
{
    public function __construct(
        private readonly UnoCardType $type,
        private readonly ?Color $color = null,
        private readonly ?int $number = null,
    ) {
        parent::__construct($this->buildIdentifier());
    }

    public function getType(): UnoCardType
    {
        return $this->type;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function isWild(): bool
    {
        return $this->type === UnoCardType::Wild || $this->type === UnoCardType::WildDrawFour;
    }

    private function buildIdentifier(): string
    {
        if ($this->type === UnoCardType::Number) {
            return $this->color->value . '-' . $this->number;
        }

        if ($this->isWild()) {
            return $this->type->value;
        }

        return $this->color->value . '-' . $this->type->value;
    }
}
