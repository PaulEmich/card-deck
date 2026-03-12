# Card Deck

A PHP library for building card decks. Supports standard playing cards, Uno, and any custom card types through extension.

## Requirements

- PHP 8.1+

## Installation

```bash
composer require paulemich/card-deck
```

## Usage

### Standard 52-Card Deck

```php
use PaulEmich\CardDeck\DeckBuilder;

$deck = DeckBuilder::standard()->build();

$card = $deck->draw();
$card->getSuit();  // Suit::Hearts
$card->getRank();  // Rank::Ace
```

### Uno Deck

```php
use PaulEmich\CardDeck\DeckBuilder;

$deck = DeckBuilder::uno()->build();

$card = $deck->draw();
$card->getType();   // UnoCardType::Number
$card->getColor();  // Color::Red
$card->getNumber(); // 5
$card->isWild();    // false
```

### Multiple Decks

Use the `times` parameter to multiply a deck:

```php
use PaulEmich\CardDeck\DeckBuilder;

// 6-deck shoe for Blackjack (312 cards)
$deck = DeckBuilder::standard(times: 6)->build();
```

### Mixed Decks

Combine different deck types with individual multipliers:

```php
use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Standard\StandardDeckProvider;
use PaulEmich\CardDeck\Uno\UnoDeckProvider;

$deck = (new DeckBuilder())
    ->withDeck(new StandardDeckProvider(), times: 2)
    ->withDeck(new UnoDeckProvider(), times: 1)
    ->build();
```

### Custom Deck Provider

Implement `DeckProvider` for reusable deck configurations:

```php
use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\DeckProvider;

class TarotCard extends Card
{
    public function __construct(
        private readonly string $arcana,
        private readonly int $number,
    ) {
        parent::__construct($arcana . '-' . $number);
    }
}

/**
 * @implements DeckProvider<TarotCard>
 */
class TarotDeckProvider implements DeckProvider
{
    /** @return TarotCard[] */
    public function getCards(): array
    {
        // Return array of TarotCard
    }
}

$deck = (new DeckBuilder())
    ->withDeck(new TarotDeckProvider(), times: 2)
    ->build();
```

### Shuffling

Use built-in shufflers or create your own:

```php
use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Shuffler\RandomShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;
use PaulEmich\CardDeck\Shuffler\CutShuffler;

$deck = DeckBuilder::standard()
    ->shuffle(new RandomShuffler())
    ->build();
```

**Available shufflers:**
- `RandomShuffler` - Fisher-Yates algorithm (true random)
- `RiffleShuffler` - Splits deck, interleaves halves
- `CutShuffler` - Cuts at random point, swaps halves
- `OverhandShuffler` - Takes chunks from top, reorders

### Shuffle Chains

Combine shufflers and repeat the entire chain:

```php
use PaulEmich\CardDeck\Shuffler\ShuffleChain;
use PaulEmich\CardDeck\Shuffler\CutShuffler;
use PaulEmich\CardDeck\Shuffler\RiffleShuffler;

$shuffler = (new ShuffleChain())
    ->then(new CutShuffler())
    ->then(new RiffleShuffler())
    ->then(new CutShuffler())
    ->repeat(10);

$deck = DeckBuilder::standard(times: 6)
    ->shuffle($shuffler)
    ->build();
```

Or use the static factory:

```php
$shuffler = ShuffleChain::create([
    new CutShuffler(),
    new RiffleShuffler(),
    new CutShuffler(),
])->repeat(10);
```

### Custom Deck with Closure

```php
use PaulEmich\CardDeck\DeckBuilder;
use PaulEmich\CardDeck\Card;

$deck = (new DeckBuilder())
    ->withDeck(function (DeckBuilder $builder) {
        $builder->addCard(new Card('joker-1'));
        $builder->addCard(new Card('joker-2'));
    })
    ->build();
```

## Development

```bash
# Run tests
composer test

# Run static analysis
composer analyse

# Check code style
composer cs

# Fix code style
composer cs:fix
```

## License

MIT
