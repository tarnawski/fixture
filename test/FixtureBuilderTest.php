<?php

namespace Fixtures\Loader;

use Fixture\Driver\PDODriver;
use Fixture\FixtureBuilder;
use Fixture\Loader\FileLoader;
use Fixture\Parser\JSONParser;
use PHPUnit\Framework\TestCase;

class FixtureBuilderTest extends TestCase
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

        $loader = $this->getMockBuilder(FileLoader::class)
            ->setMethods(['load'])
            ->getMock();

        $loader->expects($this->once())
            ->method('load')
            ->willReturn('');

        $parser = $this->getMockBuilder(JSONParser::class)
            ->setMethods(['parse'])
            ->getMock();

        $parser->expects($this->once())
            ->method('parse')
            ->willReturn([]);

        $driver = $this->getMockBuilder(PDODriver::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fixtureBuilder = new FixtureBuilder($loader, $parser, $driver);
        $fixtureBuilder->load($filePath);
    }
}