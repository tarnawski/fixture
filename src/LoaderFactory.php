<?php

namespace Fixture;

use Fixture\Exception\FixtureLoaderException;
use Fixture\Loader\FileLoader;

class LoaderFactory
{
    const FILE_LOADER = 'file';
    const DEFAULT_LOADER = 'file';

    private $fileLoader;

    /**
     * LoaderFactory constructor.
     * @param FileLoader $fileLoader
     */
    public function __construct(FileLoader $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    public function getLoader(string $loader = self::DEFAULT_LOADER)
    {
        switch ($loader) {
            case self::FILE_LOADER:
                return $this->fileLoader;
                break;
            default:
                throw new FixtureLoaderException(sprintf('Loader %s not found!', $loader));
        }
    }
}
