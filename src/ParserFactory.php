<?php

namespace Fixture;

use Fixture\Exception\FixtureParserException;
use Fixture\Parser\JSONParser;
use Fixture\Parser\XMLParser;
use Fixture\Parser\YAMLParser;

class ParserFactory
{
    const YAML_PARSER = 'yaml';
    const JSON_PARSER = 'json';
    const XML_PARSER = 'xml';
    const DEFAULT_PARSER = 'yaml';

    /** @var YAMLParser */
    private $yamlParser;

    /** @var JSONParser */
    private $jsonParser;

    /** @var XMLParser */
    private $xmlParser;

    /**
     * ParserFactory constructor.
     * @param YAMLParser $yamlParser
     * @param JSONParser $jsonParser
     * @param XMLParser $xmlParser
     */
    public function __construct(YAMLParser $yamlParser, JSONParser $jsonParser, XMLParser $xmlParser)
    {
        $this->yamlParser = $yamlParser;
        $this->jsonParser = $jsonParser;
        $this->xmlParser = $xmlParser;
    }

    public function getParser(string $parser = self::DEFAULT_PARSER)
    {
        switch ($parser) {
            case self::YAML_PARSER:
                return $this->yamlParser;
                break;
            case self::XML_PARSER:
                return $this->xmlParser;
                break;
            case self::JSON_PARSER:
                return $this->jsonParser;
                break;
            default:
                throw new FixtureParserException(sprintf('Parser %s not found!', $parser));
        }
    }
}
