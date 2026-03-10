# Card Deck

A PHP library for building card decks. Supports standard playing cards, Uno, and any custom card types through extension.

## Requirements

- PHP 8.1+

## Installation

```bash
composer require paulemich/card-deck
```

## Usage

### Basic Usage

```php
use PaulEmich\CardDeck\Card;
use PaulEmich\CardDeck\DeckBuilder;

$deck = (new DeckBuilder())
    ->addCard(new Card('ace-spades'))
    ->addCard(new Card('king-hearts'))
    ->build();

$card = $deck->draw();
```

### Extending Cards

Create custom card types by extending the base `Card` class:

```php
use PaulEmich\CardDeck\Card;

class StandardCard extends Card
{
    public function __construct(
        private readonly string $suit,
        private readonly string $rank,
    ) {
        parent::__construct($suit . '-' . $rank);
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getRank(): string
    {
        return $this->rank;
    }
}
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
