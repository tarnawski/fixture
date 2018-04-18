<?php

namespace Fixtures\Loader;

use Fixture\Exception\FixtureLoaderException;
use Fixture\Loader\FileLoader;
use PHPUnit\Framework\TestCase;

class FileLoaderTest extends TestCase
{
    public function createTemporaryFile($name, $content)
    {
        $file = tempnam(sys_get_temp_dir(), $name);
        file_put_contents($file, $content);

        return $file;
    }

    public function testLoad()
    {
        $content = '{"document":[{"id":"1","name":"Secret document","status":"draft"}]}';
        $filePath = $this->createTemporaryFile('fixtures', $content);

        $loader = new FileLoader();

        $this->assertEquals(
            $content,
            $loader->load($filePath)
        );
    }

    public function testLoadNotExistFile()
    {
        $loader = new FileLoader();
        $this->expectException(FixtureLoaderException::class);
        $loader->load('not-exist-file.yml');
    }
}