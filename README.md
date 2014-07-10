Automatic API Library
=====================

[Automatic](https://www.automatic.com/) as described by their website:

> Automatic, your smartphone enabled driving assistant, gives you driving feedback, helps to diagnose check engine codes & more. Become a smarter driver today.

This is an API Library for Automatic. You can signup for a developer application [here](https://www.automatic.com/developer/). The Automatic API is **read only** for the time being and currently in alpha.

## Requirements

PHP 5.4 or later.

## Authentication

Automatic uses OAuth 2 for Authentication. This Library uses [thephpleague/oauth2-client](https://github.com/thephpleague/oauth2-client) for OAuth 2.

## Install

Via Composer

``` json
{
    "require": {
        "srtfisher/automatic": "0.1.*"
    }
}
```

## Usage

See examples in the [examples folder](https://github.com/srtfisher/automatic/tree/master/examples).

``` php
<?php
$client = new Srtfisher\Automatic\Client('client id', 'client secret', 'access token', $redirectUri);

$vehicles = $client->vehicles->all();
$vehicle = $client->vehicles->retrieve('vehicle id');
?>
```

## Todo

- Enable support for write access for when API supports it

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/srtfisher/automatic/blob/master/CONTRIBUTING.md) for details.


## License

The MIT License (MIT). Please see [License File](https://github.com/srtfisher/master/blob/master/LICENSE) for more information.
