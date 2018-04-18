<?php

use Fixture\FixtureBuilder;
use Fixture\Parser\JSONParser;
use Fixture\Driver\PDODriver;
use Fixture\Loader\FileLoader;

require_once '../vendor/autoload.php';

$loader = new FileLoader();
$parser = new JSONParser();
$driver = new PDODriver('fixture', 'fixture_mysql', '3306', 'admin', 'secret');

$fixtureBuilder = new FixtureBuilder($loader, $parser, $driver);
$fixtureBuilder->load('fixtures/document.json');
