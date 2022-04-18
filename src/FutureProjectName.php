<?php

namespace RobThree\UrlGenerator;

// This is literally a placeholder name for w/e we end up picking the new name as.
final class FutureProjectName
{
    public static function zooIdGenerator(): UrlGenerator
    {
        return new UrlGenerator(
            json_decode(
                file_get_contents(__DIR__ . '/../data/zoo-words.json'),
                true
            )
        );
    }
}