<?php

namespace HumanoID\DictionaryBuilder\Console;

use HumanoID\DictionaryBuilder\DefaultDictionaries;

class GenerateCommand
{
    private string $configPath;

    public function __construct(string $configPath)
    {
        $this->configPath = $configPath;
    }

    public static function create(string $configPath): self
    {
        return new self($configPath);
    }

    /**
     * @throws InvalidConfigException
     */
    public function generate(
        string $outputPath,
        string $mode = 'custom'
    ) {
        if ($mode === 'custom' && !file_exists($this->configPath)) {
            throw new InvalidConfigException('When using custom mode a `.humanoid.php` config file must be used.');
        }

        $fileOutPath = null;
        switch ($mode) {
            case 'space':
                $dictionary = DefaultDictionaries::spaceWords();
                $fileOutPath = 'space-words.json';
                break;
            case 'zoo':
                $dictionary = DefaultDictionaries::zooWords();
                $fileOutPath = 'zoo-words.json';
                break;
            default:
                // TODO: something about loading config
                break;
        }
        $outputPath = $this->validateOutputPath($outputPath, $fileOutPath);

        // TODO: Sort out generating the dictionaries based on mode.
        dd(
            $outputPath,
        );
    }

    /**
     * @throws InvalidConfigException
     */
    private function validateOutputPath(string $outputPath, ?string $fileOutPath): string
    {
        $realPath = realpath($outputPath);
        if (str_contains($outputPath, '.json')) {
            $dirPath = dirname($outputPath);
            $realDirPath = realpath($dirPath);
            if ($realDirPath !== false) {
                return $realDirPath . DIRECTORY_SEPARATOR . substr($outputPath, strlen($dirPath) + 1);
            }
            throw new InvalidConfigException("The output folder does not exist, please creat it first");
        }
        // Assume we will append $fileOutPath to our $outputPath
        $res = $realPath . DIRECTORY_SEPARATOR . $fileOutPath;
        if (is_file($res)) {
            throw new InvalidConfigException(
                "Generated file already exists, overwriting it will change HumanoID behavior." .
                "Delete the file manually first then re-run."
            );
        }

        return $res;
    }
}
