<?php

use Flextype\Component\Filesystem\Filesystem;

beforeEach(function() {
    filesystem()->directory(FLEXTYPE_PATH_PROJECT . '/entries')->create();
});

afterEach(function (): void {
    filesystem()->directory(FLEXTYPE_PATH_PROJECT . '/entries')->delete();
});

test('entries expression', function () {
    entries()->create('foo', ['title' => 'Foo']);
    entries()->create('entries', ['test' => '[[ entries().fetch("foo").get("title") ]]']);
    expect(entries()->fetch('entries')['test'])->toBe('Foo');
});