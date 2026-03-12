<?php

declare(strict_types=1);

use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\Shuffler\CutShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;
use PaulEmich\CardDeck\Shuffler\ShuffleChain;

it('applies shufflers in sequence', function () {
    $cards = [new Card('1'), new Card('2'), new Card('3')];

    $chain = ShuffleChain::create([
        new CutShuffler(),
        new RiffleShuffler(),
    ]);

    $result = $chain->shuffle($cards);

    expect($result)->toHaveCount(3);
});

it('can be built fluently with then()', function () {
    $cards = [new Card('1'), new Card('2'), new Card('3')];

    $chain = (new ShuffleChain())
        ->then(new CutShuffler())
        ->then(new RiffleShuffler());

    $result = $chain->shuffle($cards);

    expect($result)->toHaveCount(3);
});

it('repeats the chain multiple times', function () {
    $counter = new class implements \PaulEmich\CardDeck\Shuffler\Shuffler {
        public int $count = 0;

        public function shuffle(array $cards): array
        {
            $this->count++;

            return $cards;
        }
    };

    $chain = ShuffleChain::create([$counter])->repeat(5);
    $chain->shuffle([new Card('1')]);

    expect($counter->count)->toBe(5);
});

it('repeats entire chain not individual shufflers', function () {
    $first = new class implements \PaulEmich\CardDeck\Shuffler\Shuffler {
        public array $calls = [];

        public function shuffle(array $cards): array
        {
            $this->calls[] = 'first';

            return $cards;
        }
    };

    $second = new class implements \PaulEmich\CardDeck\Shuffler\Shuffler {
        public array $calls = [];

        public function shuffle(array $cards): array
        {
            $first = func_get_arg(0);
            $first->calls[] = 'second';

            return $cards;
        }
    };

    // Track order through first shuffler
    $chain = (new ShuffleChain())
        ->then($first)
        ->then(new class ($first) implements \PaulEmich\CardDeck\Shuffler\Shuffler {
            public function __construct(private object $tracker) {}

            public function shuffle(array $cards): array
            {
                $this->tracker->calls[] = 'second';

                return $cards;
            }
        })
        ->repeat(3);

    $chain->shuffle([new Card('1')]);

    expect($first->calls)->toBe(['first', 'second', 'first', 'second', 'first', 'second']);
});
