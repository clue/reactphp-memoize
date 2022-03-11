<?php

// $ php examples/database.php

use function Clue\React\Memoize\memoize;

require __DIR__ . '/../vendor/autoload.php';

/**
 * @return React\Promise\PromiseInterface<int,Exception>
 */
function foo(int $id): React\Promise\PromiseInterface
{
    $browser = new React\Http\Browser();
    return $browser->get('http://httpbingo.org/status/' . $id)->then(function (Psr\Http\Message\ResponseInterface $response) {
        return $response->getStatusCode();
    });
}

//foo(200)->then('var_dump', 'printf');

$memoized = memoize('foo');

$memoized(200)->then('var_dump', 'printf');
$memoized(200)->then('var_dump', 'printf');
$memoized(200)->then('var_dump', 'printf');
$memoized(200)->then('var_dump', 'printf');
$memoized(200)->then('var_dump', 'printf');
$memoized(200)->then('var_dump', 'printf');

React\EventLoop\Loop::addTimer(0.01, function () use ($memoized) {
    $memoized(200)->then('var_dump', 'printf');
});

$memoized(201)->then('var_dump', 'printf');
$memoized(201)->then('var_dump', 'printf');
$memoized(201)->then('var_dump', 'printf');
$memoized(201)->then('var_dump', 'printf');
