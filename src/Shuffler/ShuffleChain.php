<?php

declare(strict_types=1);

namespace PaulEmich\CardDeck\Shuffler;

use PaulEmich\CardDeck\Card;

class ShuffleChain implements Shuffler
{
    /** @var Shuffler[] */
    private array $shufflers = [];

    private int $times = 1;

    /**
     * @param Shuffler[] $shufflers
     */
    public static function create(array $shufflers = []): self
    {
        $chain = new self();
        $chain->shufflers = $shufflers;

        return $chain;
    }

    public function then(Shuffler $shuffler): self
    {
        $this->shufflers[] = $shuffler;

        return $this;
    }

    public function repeat(int $times): self
    {
        $this->times = $times;

        return $this;
    }

    /**
     * @param Card[] $cards
     * @return Card[]
     */
    public function shuffle(array $cards): array
    {
        for ($i = 0; $i < $this->times; $i++) {
            foreach ($this->shufflers as $shuffler) {
                $cards = $shuffler->shuffle($cards);
            }
        }

        return $cards;
    }
}
