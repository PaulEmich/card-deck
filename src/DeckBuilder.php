<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

use Closure;
use PaulEmich\CardDeck\Standard\StandardDeckProvider;
use PaulEmich\CardDeck\Uno\UnoDeckProvider;

class DeckBuilder
{
    /** @var Card[] */
    private array $cards = [];

    public static function withStandard(int $times = 1): self
    {
        return (new self())->withDeck(new StandardDeckProvider(), $times);
    }

    public static function withUno(int $times = 1): self
    {
        return (new self())->withDeck(new UnoDeckProvider(), $times);
    }

    /** @param DeckProvider|Closure(self): void $provider */
    public function withDeck(DeckProvider|Closure $provider, int $times = 1): self
    {
        if ($provider instanceof Closure) {
            for ($i = 0; $i < $times; $i++) {
                $provider($this);
            }
        } else {
            for ($i = 0; $i < $times; $i++) {
                $this->addCards($provider->getCards());
            }
        }

        return $this;
    }

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
