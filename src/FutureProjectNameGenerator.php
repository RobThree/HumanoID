<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator;

use Throwable;

class FutureProjectNameGenerator implements FutureProjectNameGeneratorInterface
{
    /**
     * Key for lookup array to store a lookup result (index).
     * Also can, technically, be anything except any of the (lowercase) chars allowed in the urls.
     */
    private const INDEX_PLACEHOLDER = 0;

    /**
     * Holds an array of word sets
     * The first level is keyed by "word category" and contains a list (array) of words by array-key
     *
     * @var array<string, array<array-key, string>>
     */
    private array $wordSetData;

    /**
     * Used to keep track of the categories contained in the data
     *
     * @var array<array-key, string>
     */
    private array $categories = [];

    /**
     * Will hold (reversed)string lookup to word index data
     * @var array<string, mixed>
     */
    private array $lookup = [];

    /**
     * Separator to use, if any
     */
    private string $separator = '-';

    private ?WordFormatOption $format;

    /**
     * @param array<string, array<array-key, string|mixed>|mixed> $wordSets
     * @param null|array<array-key, string|mixed>                 $categories
     * @param null|string                                         $separator
     * @param null|WordFormatOption                               $format
     *
     * @throws FutureProjectNameGeneratorException
     */
    public function __construct(
        array $wordSets,
        ?array $categories = null,
        ?string $separator = '-',
        ?WordFormatOption $format = null
    ) {
        // Ensure we have a list of wordsets
        if (count($wordSets) === 0) {
            throw new FutureProjectNameGeneratorException('No words specified');
        }
        // Ensure we have categories, or null was passed for 'autodetect'
        if ($categories !== null && count($categories) === 0) {
            throw new FutureProjectNameGeneratorException(
                'Categories must be either: unset (enables autodetect), or an array with size > 0, or unset'
            );
        }

        $this->wordSetData = $wordSets;
        // No categories specified, then "Autodetect" categories to use
        $this->categories = $categories ?? array_keys($this->wordSetData);

        // Check categories and build lookup table
        foreach (array_unique($this->categories) as $categoryName) {
            if (!is_string($categoryName) || strlen($categoryName) === 0) {
                throw new FutureProjectNameGeneratorException(sprintf('Category "%s" is invalid', $categoryName));
            }
            if (
                !array_key_exists($categoryName, $this->wordSetData) ||
                !is_array($this->wordSetData[$categoryName]) ||
                count($this->wordSetData[$categoryName]) === 0
            ) {
                $message = sprintf(
                    'Category "%s" not found in datafile, category is not an array or category is an empty array',
                    $categoryName
                );
                throw new FutureProjectNameGeneratorException($message);
            }

            // Ensure unique and normalized values
            // Also make sure we use array_values, because array_unique will preserve the 'key' which is our index,
            // causing missing indices on duplicate values
            $this->wordSetData[$categoryName] = array_values(array_unique(array_map(function ($s) {
                return strtolower(trim($s));
            }, $this->wordSetData[$categoryName])));

            // Initialize lookup structure; add all words to our lookup
            $this->lookup[$categoryName] = [];
            // The array_flip gives us indices (word=>index) AND de-duplicates items in a single go
            foreach (array_flip($this->wordSetData[$categoryName]) as $w => $i) {
                $this->addLookup($categoryName, $w, $i);
            }
        }

        // Set other properties
        $this->separator = $separator ?? '';

        $this->format = $format;
    }

    /**
     * Convert an integer to its respective generated {PACKAGE_NAME} ID based on the current config.
     *
     * @throws FutureProjectNameGeneratorException
     */
    public function create(int $id): string
    {
        if ($id < 0) {
            throw new FutureProjectNameGeneratorException('ID must be a positive integer');
        }

        // Initialize value to id value
        $value = $id;
        // Start at last category
        $categoryIndex = count($this->categories) - 1;
        // Array of words we calculated
        $result = [];
        // Get radix
        $radix = count($this->wordSetData[$this->categories[$categoryIndex]]);

        // Below is basically a decimal to base-N conversion
        // where each N may differ on the number of words in that category
        do {
            // Determine word for this category
            $result[] = $this->formatWord($this->getWord($categoryIndex, $value % $radix));
            // Calculate new value
            $value = (int)($value / $radix);
            // Next category (going from highest down to 0, repeating 0 if required)
            $categoryIndex = max(--$categoryIndex, 0);
            // Get radix
            $radix = count($this->wordSetData[$this->categories[$categoryIndex]]);
        } while ($value > 0);

        // Return string, glued with optional separator, in correct order
        return implode($this->separator, array_reverse($result));
    }

    /**
     * Parses an {PACKAGE_NAME} ID value and returns the integer equivalent
     *
     * @throws FutureProjectNameGeneratorException
     */
    public function parse(string $text): int
    {
        // Normalize value
        $value = strtolower(trim($text));
        // Ensure we have something to parse
        if (strlen($value) === 0) {
            throw new FutureProjectNameGeneratorException('No text specified');
        }

        // Initialize step
        $step = 1;
        // Initialize result, where the calculated ID will be stored
        $result = 0;
        // Start at last category
        $catIndex = count($this->categories) - 1;
        try {
            // Below is basically a base-N to decimal conversion
            // where each N may differ on the number of words in that category
            while ($value) {
                // Find the index of the word
                $ix = $this->lookupWordIndex($this->categories[$catIndex], $value);
                // Add the index * step to the calculated result
                $result += ($ix * $step);
                // Increase step size
                $step *= count($this->wordSetData[$this->categories[$catIndex]]);
                // Strip found word from text
                $value = substr($value, 0, -(strlen($this->getWord($catIndex, $ix)) + strlen($this->separator)));
                // Next category (going from highest down to 0, repeating 0 if required)
                $catIndex = max(--$catIndex, 0);
            }
        } catch (\Exception $ex) {
            throw new FutureProjectNameGeneratorException(sprintf('Failed to lookup "%s"', $text));
        }
        // Return calculated ID
        return $result;
    }

    /**
     * Return the word for the given category at the specified index
     */
    private function getWord(int $categoryIndex, int $wordIndex): string
    {
        return $this->wordSetData[$this->categories[$categoryIndex]][$wordIndex];
    }

    /**
     * Formats a word depending on the format
     */
    private function formatWord(string $word): string
    {
        switch ($this->format) {
            case WordFormatOption::ucfirst():
                return ucfirst($word);
            case WordFormatOption::lcfirst():
                return lcfirst($word);
            case WordFormatOption::upper():
                return strtoupper($word);
            case WordFormatOption::lower():
                return strtolower($word);
            default:
                return $word;
        }
    }

    /**
     * Returns the index of a word in the given category
     *
     * @throws FutureProjectNameGeneratorException
     */
    private function lookupWordIndex(string $category, string $word): int
    {
        $p = &$this->lookup[$category];
        $lastIx = null;
        for ($i = strlen($word) - 1; $i >= 0; $i--) {
            $c = $word[$i];
            if (!array_key_exists($c, $p)) {
                break;
            }

            $p = &$p[$c];
            if (array_key_exists(self::INDEX_PLACEHOLDER, $p)) {
                $lastIx = $p[self::INDEX_PLACEHOLDER];
            }
        }
        if ($lastIx !== null) {
            return $lastIx;
        }

        throw new FutureProjectNameGeneratorException(sprintf('Failed to lookup "%s"', $word));
    }

    /**
     * Adds a word to the lookup table
     */
    private function addLookup(string $category, string $word, int $index): void
    {
        $p = &$this->lookup[$category];
        for ($i = strlen($word) - 1; $i >= 0; $i--) {
            $c = $word[$i];
            if (!array_key_exists($c, $p)) {
                $p[$c] = [];
            }
            $p = &$p[$c];
        }

        $p[self::INDEX_PLACEHOLDER] = $index;
    }
}
