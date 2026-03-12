<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck;

use Closure;
use PaulEmich\CardDeck\Shuffler\Shuffler;
use PaulEmich\CardDeck\Standard\StandardDeckProvider;
use PaulEmich\CardDeck\Uno\UnoDeckProvider;

class DeckBuilder
{
    /** @var Card[] */
    private array $cards = [];

    public static function standard(int $times = 1): self
    {
        return (new self())->withDeck(new StandardDeckProvider(), $times);
    }

    public static function uno(int $times = 1): self
    {
        return (new self())->withDeck(new UnoDeckProvider(), $times);
    }

    /**
     * @template TCard of Card
     * @param DeckProvider<TCard>|Closure(self): void $provider
     */
    public function withDeck(DeckProvider|Closure $provider, int $times = 1): self
    {
        if ($provider instanceof Closure) {
            for ($i = 0; $i < $times; $i++) {
                $provider($this);
            }
        } else {
            for ($i = 0; $i < $times; $i++) {
                $this->cards = [...$this->cards, ...$provider->getCards()];
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
        $this->cards = [...$this->cards, ...$cards];

        return $this;
    }

    public function shuffle(Shuffler $shuffler): self
    {
        $this->cards = $shuffler->shuffle($this->cards);

        return $this;
    }

    /** @return Deck<Card> */
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
