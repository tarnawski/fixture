<?php

namespace Fixture\Parser;

use Fixture\Exception\FixtureParserException;
use Fixture\ParserInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YAMLParser
 * @package Fixture\Parser
 */
class YAMLParser implements ParserInterface
{
    /**
     * parse YAML file
     * @param $data
     * @return mixed
     * @throws FixtureParserException
     */
    public function parse($data)
    {
        try {
            $data = Yaml::parse($data);
        } catch (ParseException $exception) {
            throw new FixtureParserException($exception->getMessage());
        }

        return $data;
    }
}
