<?php

namespace Fixtures\Loader;

use Fixture\Exception\FixtureParserException;
use Fixture\Parser\JSONParser;
use PHPUnit\Framework\TestCase;

class JSONParserTest extends TestCase
{
    public function testParse()
    {
        $content = '{"document":[{"id":"1","name":"Secret document","status":"draft"}]}';
        $expected = [
            'document' => [
                [
                    'id' => 1,
                    'name' => 'Secret document',
                    'status' => 'draft'
                ]
            ]
        ];

        $parser = new JSONParser();

        $this->assertEquals($expected, $parser->parse($content));
    }

    public function testParseInvalidData()
    {
        $content = 'Some incorrect JSON content';
        $parser = new JSONParser();
        $this->expectException(FixtureParserException::class);
        $parser->parse($content);
    }
}