# ![Logo](logo.png) HumanoID

[![Packagist](https://img.shields.io/packagist/v/robthree/humanoid.svg)](https://packagist.org/packages/robthree/humanoid) [![Packagist](https://img.shields.io/packagist/dt/robthree/humanoid.svg)](https://packagist.org/packages/robthree/humanoid)

This class can be used to generate "friendly id's" where numerical ID's are replaced with words. A well known example is [Gfycat]([https://gfycat.com/about](https://gfycat.com/about)) which uses "`adjectiveadjectiveanimal`": [`https://gfycat.com/gracefulspanishgemsbuck`](https://gfycat.com/gracefulspanishgemsbuck).

This class has two methods: `create(int $id)` which returns a string generated from the id and `parse(string $text)` which returns the id from the parsed text. It supports custom  word / category lists, an optional separator and optional formatting.

## Quickstart

Usage:

```php
// Create new instance of HumanoID via the builder
$zooIdGen = HumanoIDs::zooIdGenerator();

// Convert ID to HumanoID
$zooId = $zooIdGen->create(96712);
echo sprintf("HumanoID   : %s\n", $zooId);
    
// Convert back to ID
$id = $zooIdGen->parse($zooId);
echo sprintf("Decoded ID : %d\n", $id);
```

Output (depending on the wordlist used):

```
HumanoId   : 'sick-yellow-wolf'
Decoded ID : 96712
```

## API

The `HumanoID` has a constructor with 4 arguments; all of which but the first are optional:

- `$wordSets`: The words-structure ([see below](#word-lists-and-categories)) to use as 'dictionary'
- `$categories` (*optional*, [see below](#word-lists-and-categories)): if you want to use a different order for categories than the default order (which is the order of the keys of the `$words` argument)
- `$separator` (*optional*, [see below](#separator)): the separator, if any, to use
- `$format` (*optional*, [see below](#formats)): the format to use

The `HumanoID` has two public methods:

- `create(int $id): string`: Converts an integer into an ID
- `parse(string $text): int`: Converts text into an integer

    
## Word lists and categories

You can use custom word lists; you can store these anywhere you want like in a JSON file or in a database. As long as you initialize the `HumanoID` class with the following data structure:

    [
        'adjectives' => ['big', 'smart', 'funky'],
        'colors'     => ['red', 'green', 'blue'],
        'animals'    => ['cow", 'whale', 'monkey'],
    ]

The `HumanoID` will automatically determine which 'categories' are available. In the above example generated HumanoIDs would take the form `adjective-color-animal`. Whenever this should turn out to be not enough, the `HumanoID` automatically repeats the first category as often as needed; so this would result in `adjective-adjective-color-animal` or even `adjective-adjective-adjective-color-animal` and so on. However, the order of the categories can be specified by passing an array of words to the `$categories` argument of the `HumanoID` class. You could, for example, pass `['colors', 'adjectives', 'animals']` which will result in HumanoIDs that take the form `color-adjective-animal` or, again, when this should not be enough: `color-color-color-adjective-animal`.

Ofcourse you don't have to use adjectives, colors and animals. It can be anything you want. So, more generalized, you can provide any data structure in the form

    [
        'cateogory1' =>  ['value', 'value', 'value', ...],
        'cateogory2' =>  ['value', 'value', "value', ...],
        ...
    ]
    
## Separator

By default `HumanoID` uses the `-` character to separate words. This results in HumanoIDs like `big-red-whale`. You can specify any desired string as a separator; it helps if the separator string is not contained in any of the words. 

It is possible to specify an empty (`''`) or `null` separator. This will result in HumanoIDs like `bigredwhale`. This is the closest to what Gfycat url's look like. However, you need to take extreme care that the words don't overlap. If, for example, the adjectives would contain both `old` and `cold` a HumanoID like `genericoldpanda` will result in an ambiguous result ("generi", "**cold**", "panda" vs. "generi**c"**, "**old**", "panda"). With a carefully generated wordlist this shouldn't have to be a problem.

## Formats

A few formats are supported which can be specified when constructing an instance of the `HumanoID` class. The currently supported formats are provided via a `WordFormatOption` Enum class.

The options provided are:
- `WordFormatOption::ucfirst`,
- `WordFormatOption::lcfirst`,
- `WordFormatOption::upper`,
- `WordFormatOption::lower`, and 
- no-format (`null`).

All options do what their name implies; so `ucfirst` would result in `Big-Red-Whale` and `upper` in `BIG-RED-WHALE`. The "no-format" option just keeps the words intact as formatted from the provided wordset.

## How it works

### ID (integer) to HumanoID conversion

The `create(int $id): string` method takes the ID and, basically, does a [base conversion]([https://en.wikipedia.org/wiki/Numeral_system](https://en.wikipedia.org/wiki/Numeral_system)) similarly to how you would convert the decimal value `967` to the hexadecimal value `3C7`.

However, this time we don't have 16 'digits' (0..9, A..F), but any number of words representing a digit.

### HumanoID to ID (integer) conversion

The `parse(string $text): int` method does, basically the opposite of the `create` method; it takes a string and tries to do another base conversion, similarly as how you would convert the hexadecimal value `3C7` to the decimal value `967`. However, this time it's a bit more complicated...

**If** we could assume there will always be a separator 'per digit' in the string, we could simply split the string at the separator and do our calculations. Even if the separator would not be used but, for example, the `ucfirst` option (resulting in `BigRedWhale`) we could split out the words pretty easily.

**However**; We wanted to stay as close as possible to the Gfycat implementation. And that complicates things. This, basically, meant we had the following requirements: the url should be case insensitive *and* contain an *optional* separator.

The 'decoding' of a HumanoIDs relies on a lookup table which is created when the `HumanoID` class is initialized (which, by the way, is a pretty expensive operation; keep the instance around as long as you can if you need to generate or parse more than one HumanoID!).

We won't go into too much detail, but in essence a tree is created on a per-character-basis in reverse order. When decoding a HumanoIDs the algorithm starts at the end working it's way to the beginning of the string while meanwhile working it's way down this tree and looking up word indices in their respective categories. Whenever an index is determined it can be used in the 'base-N' conversion and the algorithm continues until the beginning of the HumanoIDs is reached or a lookup failed.

## General advice

- **Don't** change your wordlist once you go into production. Imagine reassigning or reordering the value of the values `A..F` in the hexadecimal system. It will be very hard, if not impossible, to make this work correctly without resulting in incorrectly converted HumanoIDsss to ID's or causing ambiguous results etc.
- Use large word-lists. *Don't go overboard*, but categories with a handful of words don't help much (*unless* you don't mind either long HumanoIDs.(`red-blue-blue-red-red-blue-funky-monkey` for example) or have some more smaller categories).
- Whatever wordlist/separator/format you decide on, once you picked it, you're stuck with it (unless you want to break all your HumanoIDs or you'll need to do some (on-the-fly?) conversion.
- When not using any separator, try to use longer, unique, words that are not contained in other words (so, for example, avoid "`old`, `cold`" or "`expensive`,`inexpensive`").
- If ambiguous words without a separator are unavoidable or desired you could consider only using the `create(int $id)` method and storing the result alongside the `id` in your data. Apply a unique constraint and index if you can. That way you can use the field with the HumanoID value to do a lookup.
- [As mentioned earlier](#humanoid-to-ID-integer-conversion); try to keep this class around for as long as possible. The constructor contains some fairly CPU intensive code (building the lookup table), so ideally you keep an instance alive for as long as possible.

### Notes
The 'ambiguous words' problem _can_ probably be solved in a later version by changing the iteratively lookup process into a recusive algorithm; that way when a lookup turns out to fail (again, `cold`, `old` for example) the next value can be tried recursively until the HumanoID is completely decoded correctly (or still fail as a whole).

## Pronunciation

Humanoid is pronounced "humano i d" (`/ˈhjuːmənəʊ aɪ diː/`), but "humanoid" (`/ˈhjuːmənɔɪd/`) is fine too if you like to please the robots.

## License

Licensed under MIT license. See [LICENSE](LICENSE) for details.

---

Logo and icon based on icons made by [Vectorslab](https://www.flaticon.com/authors/vectorslab/flat) ([#7323564](https://www.flaticon.com/free-icon/chatbot_7323564)) and [Those Icons](https://www.flaticon.com/authors/those-icons) ([#523788](https://www.flaticon.com/free-icon/lego_523788)) over at [FlatIcon](https://www.flaticon.com/).
