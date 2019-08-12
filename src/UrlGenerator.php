<?php
declare(strict_types=1);

namespace UrlGenerator;

class UrlGenerator {
    private $data;                      // Holds an array with category => string-array data with the words to use in the url
    private $categories;                // Used to keep track of the categories contained in the data
    private $lookup;                    // Will hold (reversed)string lookup to word index data
    private $separator;                 // Separator to use, if any
    private $format;                    // Format to use (one of 'ucfirst', 'lcfirst', 'upper', 'lower' or null for no formatting
    private const INDEXPLACEHOLDER = 0; // Key for lookup array to store a lookup result (index). Can, technically, be anything except any of the (lowercase) chars allowed in the urls.
    
    public function __construct(array $words, ?array $categories = null, ?string $separator = '-', string $format = null) {
        if (sizeof($words) === 0)
            throw new UrlGeneratorException('No words specified');
        $this->data = $words;

        // No categories specified? "Autodetect" categories to use
        if ($categories === null)
            $categories = array_keys($this->data);
        
        // Ensure we have categories
        if (sizeof($categories) === 0)
            throw new UrlGeneratorException('Categories must be an array with size > 0');
        $this->categories = $categories;
        $this->lookup = [];
        
        // Check categories and build lookup table
        foreach (array_unique($this->categories) as $k) {
            if (!is_string($k) || strlen($k) === 0)
                throw new UrlGeneratorException(sprintf('Category "%s" is invalid', $k));
            if (!array_key_exists($k, $this->data) || !is_array($this->data[$k]) || sizeof($this->data[$k]) === 0)
                throw new UrlGeneratorException(sprintf('Category "%s" not found in datafile, category is not an array or category is an empty array', $k));

            // Ensure unique, normalized, values (make sure we use array_values, because array_unique will preserve the 'key' which is our index, causing missig indices on duplicate values)
            $this->data[$k] = array_values(array_unique(array_map(function($s) { return trim(strtolower($s)); }, $this->data[$k])));

            // Initialize lookup structure; add all words to our lookup
            $this->lookup[$k] = [];
            foreach (array_flip($this->data[$k]) as $w => $i) // The array_flip gives us indices (word=>index) AND deduplicates items in a single go
                $this->addLookup($k, $w, $i);
        }
        
        // Set other properties
        $this->separator = $separator;
        
        $format = trim(strtolower($format ?? ''));
        switch ($format) {
            case '':
            case 'ucfirst':
            case 'lcfirst':
            case 'upper':
            case 'lower':
                $this->format = $format;
                break;
            default:
                throw new UrlGeneratorException(sprintf('Unsupported format "%s"', $format));
        }
    }
    
    public function toURL(int $id) : string {
        if ($id < 0)
            throw new UrlGeneratorException('ID must be a postive integer');

        $value = $id;                               // Initialize value to id value
        $catindex = sizeof($this->categories) - 1;  // Start at last category
        $result = [];                               // Array of words we calculated
        $radix = sizeof($this->data[$this->categories[$catindex]]);                 // Get radix
        
        // Below is basically a decimal to base-N conversion where each N may differ on the number of words in that category
        do {
            $result[] = $this->formatWord($this->getWord($catindex, $value % $radix));  // Determine word for this category
            $value = (int)($value / $radix);                                            // Calculate new value
            $catindex = max(--$catindex, 0);                                            // Next category (going from highest down to 0, repeating 0 if required)
            $radix = sizeof($this->data[$this->categories[$catindex]]);                 // Get radix
        } while ($value > 0);
        
        // Return string, glued with optional separator, in correct order
        return implode($this->separator, array_reverse($result));
    }
    
    public function parseUrl(string $text) : int {
        $value = strtolower(trim($text));               // Normalize value
        if (strlen($value) === 0)                       // Ensure we have something to parse
            throw new UrlGeneratorException('No text specified');

        $step = 1;                                      // Initialize step
        $result = 0;                                    // Initialize result, where the calculated ID will be stored
        $catindex = sizeof($this->categories) - 1;      // Start at last category
        try {
            // Below is basically a base-N to decimal conversion where each N may differ on the number of words in that category
            while ($value) {
                $ix = $this->lookupWordIndex($this->categories[$catindex], $value); // Find the index of the word
                $result += ($ix * $step);                                           // Add the index * step to the calculated result
                $step *= sizeof($this->data[$this->categories[$catindex]]);         // Increase step size
                $value = substr($value, 0, -(strlen($this->getWord($catindex, $ix)) +  strlen($this->separator)));  // Strip found word from text
                $catindex = max(--$catindex, 0);                                    // Next category (going from highest down to 0, repeating 0 if required)
            }
        } catch (Exception $ex) {
            throw new UrlGeneratorException(sprintf('Failed to lookup "%s"', $text));
        }
        // Return calculated ID
        return $result;
    }
    
    private function getWord(int $catindex, int $index) : string {
        // Return the word for the given category at the specified index
        return $this->data[$this->categories[$catindex]][$index];
    }
    
    private function formatWord($word) {
        switch ($this->format) {
            case 'ucfirst': return ucfirst($word);
            case 'lcfirst': return lcfirst($word);
            case 'upper':   return strtoupper($word);
            case 'lower':   return strtolower($word);
            default: return $word;
        }
    }
    
    private function lookupWordIndex(string $category, string $word) : int {
        $p = &$this->lookup[$category];
        $lastix = null;
        for ($i = strlen($word)-1; $i >= 0; $i--) {
            $c = $word[$i];
            if (!array_key_exists($c, $p))
                break;

            $p = &$p[$c];
            if (array_key_exists(self::INDEXPLACEHOLDER, $p))
                $lastix = $p[self::INDEXPLACEHOLDER];
        }
        if ($lastix === null)
            throw new UrlGeneratorException(sprintf('Failed to lookup "%s"', $word));
        return $lastix;
    }
    
    private function addLookup(string $category, string $word, int $index) : void {
        $p = &$this->lookup[$category];
        for ($i = strlen($word)-1; $i >= 0; $i--) {
            $c = $word[$i];
            if (!array_key_exists($c, $p))
                $p[$c] = [];
            $p = &$p[$c];
        }
        
        $p[self::INDEXPLACEHOLDER] = $index;
    }
}

class UrlGeneratorException extends \Exception {
    //public function __construct($message = null, $code = 0, Exception $previous = null) {
    //
    //}
}
