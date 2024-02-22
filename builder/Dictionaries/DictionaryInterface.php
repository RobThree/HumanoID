<?php

namespace HumanoID\DictionaryBuilder\Dictionaries;

interface DictionaryInterface
{
    /**
     * This is the structured dictionary that is provided.
     * @return array
     */
    public static function dictionary(): array;

    /**
     * This should return a single list of all the words possible.
     * @return string[]
     */
    public static function all(): array;
}