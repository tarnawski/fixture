<?php

namespace Fixture\Parser;

use Fixture\Exception\FixtureParserException;
use Fixture\ParserInterface;

/**
 * Class JSONParser
 * @package Fixture\Parser
 */
class JSONParser implements ParserInterface
{
    /**
     * Parse JSON file
     * @param $data
     * @return mixed
     * @throws FixtureParserException
     */
    public function parse($data)
    {
        $data = json_decode($data, true);

        if ($data === null) {
            throw new FixtureParserException('Invalid JSON file!');
        }

        return $data;
    }
}
