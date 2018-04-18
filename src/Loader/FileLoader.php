<?php

namespace Fixture\Loader;

use Fixture\Exception\FixtureLoaderException;
use Fixture\LoaderInterface;

/**
 * Class FileLoader
 * @package Fixture\Loader
 */
class FileLoader implements LoaderInterface
{
    /**
     * Load data from file
     * @param string $path
     * @return bool|string
     * @throws FixtureLoaderException
     */
    public function load(string $path)
    {
        if (false === file_exists($path)) {
            throw new FixtureLoaderException('File not exist!');
        }

        return file_get_contents($path);
    }
}
