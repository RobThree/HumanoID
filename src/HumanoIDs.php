<?php

declare(strict_types=1);

namespace RobThree\HumanoID;

use RobThree\HumanoID\Obfuscatories\SymetricObfuscatorInterface;

final class HumanoIDs
{
    private static ?HumanoID $zooGenerator = null;
    private static ?HumanoID $spaceGenerator = null;

    public static function zooIdGenerator(
        ?string $separator = '-',
        ?WordFormatOption $format = null,
        ?SymetricObfuscatorInterface $obfuscator = null
    ): HumanoID {
        if (self::$zooGenerator === null) {
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
        return self::$zooGenerator;
    }

    public static function spaceIdGenerator(
        ?string $separator = '-',
        ?WordFormatOption $format = null,
        ?SymetricObfuscatorInterface $obfuscator = null
    ): HumanoID {
        if (self::$spaceGenerator === null) {
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
        return self::$spaceGenerator;
    }
}
