# clue/reactphp-memoize

Automatically memoize async function calls by caching function results,
built on top of [ReactPHP](https://reactphp.org/).

**Table of contents**

* [Quickstart example](#quickstart-example)
* [Install](#install)
* [License](#license)

## Quickstart example

Once [installed](#install), you can use the following code to decorate a demo
function and avoid sending unneeded HTTP requests:

```php
$browser = new React\Http\Browser($loop);

$fetch = function (int $id) use ($browser) {
    return $browser->get('http://httpbingo.org/status/' . $id)->then(function (ResponseInterface $response) {
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

[![A clue·access project](https://raw.githubusercontent.com/clue-access/clue-access/main/clue-access.png)](https://github.com/clue-access/clue-access)

*This project is currently under active development,
you're looking at a temporary placeholder repository.*

The code is available in early access to my sponsors here: https://github.com/clue-access/reactphp-memoize

Do you sponsor me on GitHub? Thank you for supporting sustainable open-source, you're awesome! ❤️ Have fun with the code! 🎉

Seeing a 404 (Not Found)? Sounds like you're not in the early access group. Consider becoming a [sponsor on GitHub](https://github.com/sponsors/clue) for early access. Check out [clue·access](https://github.com/clue-access/clue-access) for more details.

This way, more people get a chance to take a look at the code before the public release.

Rock on 🤘

## License

This project will be released under the permissive [MIT license](LICENSE).

> Did you know that I offer custom development services and issuing invoices for
  sponsorships of releases and for contributions? Contact me (@clue) for details.
