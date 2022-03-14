# clue/reactphp-memoize

Automatically memoize async function calls by caching function results,
built on top of [ReactPHP](https://reactphp.org/).

**Table of contents**

* [Support us](#support-us)
* [Quickstart example](#quickstart-example)
* [Install](#install)
* [License](#license)

## Support us

[![A clue·access project](https://raw.githubusercontent.com/clue-access/clue-access/main/clue-access.png)](https://github.com/clue-access/clue-access)

*This project is currently under active development,
you're looking at a temporary placeholder repository.*

The code is available in early access to my sponsors here: https://github.com/clue-access/reactphp-memoize

Do you sponsor me on GitHub? Thank you for supporting sustainable open-source, you're awesome! ❤️ Have fun with the code! 🎉

Seeing a 404 (Not Found)? Sounds like you're not in the early access group. Consider becoming a [sponsor on GitHub](https://github.com/sponsors/clue) for early access. Check out [clue·access](https://github.com/clue-access/clue-access) for more details.

This way, more people get a chance to take a look at the code before the public release.

## Quickstart example

Once [installed](#install), you can use the following code to decorate a demo
function and avoid sending unneeded HTTP requests:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$browser = new React\Http\Browser();

$fetch = function (int $id) use ($browser) {
    return $browser->get(
        'http://httpbingo.org/status/' . $id
    )->then(function (Psr\Http\Message\ResponseInterface $response) {
        return $response->getStatusCode();
    });
}

$memoized = Clue\React\Memoize\memoize($fetch);

$memoized(200)->then('var_dump', 'printf');
$memoized(200)->then('var_dump', 'printf');
```

This example invokes the memoized function twice, but only sends a single HTTP
request. The underlying function executes asynchronously and additional
invocations will be locked until the first call is completed.

The return values will be cached for the respective function arguments. If you
pass different arguments to each function call, it will invoke the underlying
function multiple times.

## Install

The recommended way to install this library is [through Composer](https://getcomposer.org/).
[New to Composer?](https://getcomposer.org/doc/00-intro.md)

This project does not yet follow [SemVer](https://semver.org/).
This will install the latest supported version:

While in [early access](#support-us), you first have to manually change your
`composer.json` to include these lines to access the supporters-only repository:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/clue-access/reactphp-memoize"
        }
    ]
}
```

Then install this package as usual:

```bash
$ composer require clue/reactphp-memoize:dev-main
```

This project aims to run on any platform and thus does not require any PHP
extensions and supports running on PHP 7.3 through current PHP 8+.

## Tests

To run the test suite, you first need to clone this repo and then install all
dependencies [through Composer](https://getcomposer.org/):

```bash
$ composer install
```

To run the test suite, go to the project root and run:

```bash
$ vendor/bin/phpunit
```

## License

This project is released under the permissive [MIT license](LICENSE).

> Did you know that I offer custom development services and issuing invoices for
  sponsorships of releases and for contributions? Contact me (@clue) for details.
