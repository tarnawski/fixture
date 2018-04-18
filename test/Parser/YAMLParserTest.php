<?php

namespace Fixtures\Loader;

use Fixture\Exception\FixtureParserException;
use Fixture\Parser\YAMLParser;
use PHPUnit\Framework\TestCase;

class YAMLParserTest extends TestCase
{
    public function testParse()
    {
        $content = <<<YAML
document:
  - id: 1
    name: Secret document
    status: draft
YAML;

        $expected = [
            'document' => [
                [
                    'id' => 1,
                    'name' => 'Secret document',
                    'status' => 'draft'
                ]
            ]
        ];

        $parser = new YAMLParser();

        $this->assertEquals($expected, $parser->parse($content));
    }

    public function testParseInvalidData()
    {
        $content = <<<YAML
document:
- id: 1
    name: Secret document
  status: draft
YAML;
        $parser = new YAMLParser();
        $this->expectException(FixtureParserException::class);
        $parser->parse($content);
    }
}