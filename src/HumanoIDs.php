<?php

declare(strict_types=1);

namespace RobThree\HumanoID;

use RobThree\HumanoID\Obfuscatories\SymmetricObfuscatorInterface;

final class HumanoIDs
{
    private static ?HumanoID $zooGenerator = null;
    private static ?array $zooGeneratorArgs = null;
    private static ?HumanoID $spaceGenerator = null;
    private static ?array $spaceGeneratorArgs = null;

    public static function zooIdGenerator(
        ?string $separator = '-',
        ?WordFormatOption $format = null,
        ?SymmetricObfuscatorInterface $obfuscator = null
    ): HumanoID {
        if (self::$zooGenerator === null) {
            self::$zooGeneratorArgs = func_get_args();
            self::$zooGenerator = new HumanoID(
                json_decode(
                    file_get_contents(__DIR__ . '/../data/zoo-words.json'),
                    true
                ),
                null,
                $separator,
                $format,
                $obfuscator
            );
        }

        if (self::$zooGeneratorArgs !== func_get_args()) {
            trigger_error(
                "Calling zooIdGenerator with different arguments will result in a new instance of HumanoID being created each time. " .
                "Instead consider constructing a new instance of HumanoID directly",
                E_USER_WARNING
            );
            self::$zooGenerator = new HumanoID(
                json_decode(
                    file_get_contents(__DIR__ . '/../data/zoo-words.json'),
                    true
                ),
                null,
                $separator,
                $format
            );
        }

        return self::$zooGenerator;
    }

    public static function spaceIdGenerator(
        ?string $separator = '-',
        ?WordFormatOption $format = null,
        ?SymmetricObfuscatorInterface $obfuscator = null
    ): HumanoID {
        if (self::$spaceGenerator === null) {
            self::$spaceGeneratorArgs = func_get_args();
            self::$spaceGenerator = new HumanoID(
                json_decode(
                    file_get_contents(__DIR__ . '/../data/space-words.json'),
                    true
                ),
                null,
                $separator,
                $format,
                $obfuscator
            );
        }

        if (self::$spaceGeneratorArgs !== func_get_args()) {
            trigger_error(
                "Calling spaceIdGenerator with different arguments will result in a new instance of HumanoID being created each time. " .
                "Instead consider constructing a new instance of HumanoID directly",
                E_USER_WARNING
            );
            self::$spaceGenerator = new HumanoID(
                json_decode(
                    file_get_contents(__DIR__ . '/../data/space-words.json'),
                    true
                ),
                null,
                $separator,
                $format
            );
        }

        return self::$spaceGenerator;
    }
}
