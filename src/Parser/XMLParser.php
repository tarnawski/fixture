<?php

namespace Fixture\Parser;

use Fixture\Exception\FixtureParserException;
use Fixture\ParserInterface;

/**
 * Class XMLParser
 * @package Fixture\Parser
 */
class XMLParser implements ParserInterface
{
    /**
     * Parse XML file
     * @param $data
     * @return mixed
     * @throws FixtureParserException
     */
    public function parse($data)
    {
        libxml_use_internal_errors(true);
        $data = simplexml_load_string($data, "SimpleXMLElement", LIBXML_NOCDATA);

        if ($data === false) {
            throw new FixtureParserException('Invalid XML file!');
        }

        $data = json_encode($data);
        $data = json_decode($data, TRUE);

        if ($data === null) {
            throw new FixtureParserException('Invalid XML file!');
        }

        return $data;
    }
}
