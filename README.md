# Fixtures loader
Tool to help manage fixtures in a PHP project

[![Build Status](https://travis-ci.org/tarnawski/fixture.svg?branch=master)](https://travis-ci.org/tarnawski/fixture)

## Installation
```bash
$ composer require tarnawski/fixtures
```

## Supported type of fixtures file
### YAML
```yaml
document:
  - id: 1
    name: Secret document
    status: draft
  - id: 2
    name: Other document
    status: published
```

### JSON
```json
{
  "document": [
      {
        "id": "1",
        "name": "Secret document",
        "status": "draft"
      },
      {
        "id": "2",
        "name": "Other document",
        "status": "published"
      }
    ]
}
```

### XML
```xml
<?xml version="1.0" encoding="UTF-8"?>
<fixtures>
    <document>
        <id>1</id>
        <name>Secret document</name>
        <status>draft</status>
    </document>
    <document>
        <id>2</id>
        <name>Other document</name>
        <status>published</status>
    </document>
</fixtures>
```

## Usage standalone
```php
$loader = new FileLoader();
$parser = new JSONParser();
$driver = new PDODriver('database', 'host', 'port', 'user', 'passoword');
$fixtureBuilder = new FixtureBuilder($loader, $parser, $driver);
$fixtureBuilder->load('fixtures/document.json');
```

## Usage with Symfony
1. Enable the Bundle
```php
$bundles = array(
    new Fixture\Bridge\Symfony\FixtureBundle(),
);

```
2. Configure the Bundle
```yaml
fixture:
    path: '%kernel.project_dir%/fixtures/document.json'
    loader: 'file'
    parser: 'json'
    driver: 'pdo'
```