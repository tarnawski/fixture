<?php

namespace Fixture\Bridge\Symfony\Command;

use Fixture\DriverInterface;
use Fixture\LoaderInterface;
use Fixture\ParserInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixtureCommand extends Command
{
    /** @var LoaderInterface */
    private $loader;

    /** @var ParserInterface */
    private $parser;

    /** @var DriverInterface */
    private $driver;

    /** @var string */
    private $path;

    /**
     * FixtureCommand constructor.
     * @param LoaderInterface $loader
     * @param ParserInterface $parser
     * @param DriverInterface $driver
     * @param string $path
     */
    public function __construct(LoaderInterface $loader, ParserInterface $parser, DriverInterface $driver, $path)
    {
        parent::__construct();

        $this->loader = $loader;
        $this->parser = $parser;
        $this->driver = $driver;
        $this->path = $path;
    }

    protected function configure()
    {
        $this->setName('fixture:load')
            ->setDescription('Load fixtures')
            ->setHelp('This command allows you to load fixtures...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this->loader->load($this->path);
        $data = $this->parser->parse($data);
        $this->driver->load($data);

        $output->writeln('Load finished!');
    }
}
