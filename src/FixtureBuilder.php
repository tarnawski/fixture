<?php

namespace Fixture;

class FixtureBuilder
{
    /** @var LoaderInterface */
    private $loader;

    /** @var ParserInterface */
    private $parser;

    /** @var DriverInterface */
    private $driver;

    /**
     * FixtureBuilder constructor.
     * @param LoaderInterface $loader
     * @param ParserInterface $parser
     * @param DriverInterface $driver
     */
    public function __construct(LoaderInterface $loader, ParserInterface $parser, DriverInterface $driver)
    {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->driver = $driver;
    }

    /**
     * @param string $path
     */
    public function load(string $path)
    {
        $data = $this->loader->load($path);
        $data = $this->parser->parse($data);
        $this->driver->load($data);
    }
}
