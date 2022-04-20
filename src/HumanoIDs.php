<?php

declare(strict_types=1);

namespace RobThree\HumanoID;

final class HumanoIDs
{
    public static function zooIdGenerator(
        ?string $separator = '-',
        ?WordFormatOption $format = null
    ): HumanoID {
        return new HumanoID(
            json_decode(
                file_get_contents(__DIR__ . '/../data/zoo-words.json'),
                true
            ),
            null,
            $separator,
            $format
        );
    }

    public static function spaceIdGenerator(
        ?string $separator = '-',
        ?WordFormatOption $format = null
    ): HumanoID {
        return new HumanoID(
            json_decode(
                file_get_contents(__DIR__ . '/../data/space-words.json'),
                true
            ),
            null,
            $separator,
            $format
        );
    }
}
