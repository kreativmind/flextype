<?php

use Flextype\Component\Filesystem\Filesystem;

beforeEach(function() {
    filesystem()->directory(PATH_PROJECT . '/entries')->create();
});

afterEach(function (): void {
    filesystem()->directory(PATH_PROJECT . '/entries')->delete();
});

test('strings expression', function () {
    entries()->create('strings', ['test' => '[[ strings("Foo").lower() ]]']);
    expect(entries()->fetch('strings')['test'])->toBe('foo');
});