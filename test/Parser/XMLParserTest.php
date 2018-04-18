<?php

namespace Fixtures\Loader;

use Fixture\Exception\FixtureParserException;
use Fixture\Parser\JSONParser;
use Fixture\Parser\XMLParser;
use PHPUnit\Framework\TestCase;

class XMLParserTest extends TestCase
{
    public function testParse()
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?><fixtures><document><id>1</id><name>Secret document</name><status>draft</status></document><document><id>2</id><name>Other document</name><status>published</status></document></fixtures>';
        $expected = [
            'document' => [
                [
                    'id' => 1,
                    'name' => 'Secret document',
                    'status' => 'draft'
                ],
                [
                    'id' => 2,
                    'name' => 'Other document',
                    'status' => 'published'
                ]
            ]
        ];

        $parser = new XMLParser();

        $this->assertEquals($expected, $parser->parse($content));
    }

    public function testParseInvalidData()
    {
        $content = 'Some incorrect XML content';
        $parser = new XMLParser();
        $this->expectException(FixtureParserException::class);
        $parser->parse($content);
    }
}