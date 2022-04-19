<?php

declare(strict_types=1);

namespace RobThree\UrlGenerator;

// This is literally a placeholder name for w/e we end up picking the new name as.
final class FutureProjectName
{
    public static function zooIdGenerator(
        ?string $separator = '-',
        ?WordFormatEnum $format = null
    ): FutureProjectNameGenerator {
        return new FutureProjectNameGenerator(
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
        ?WordFormatEnum $format = null
    ): FutureProjectNameGenerator {
        return new FutureProjectNameGenerator(
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
