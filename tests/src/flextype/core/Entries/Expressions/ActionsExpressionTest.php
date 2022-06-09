<?php

use Flextype\Component\Filesystem\Filesystem;

beforeEach(function() {
    filesystem()->directory(PATH_PROJECT . '/entries')->create();
});

afterEach(function (): void {
    filesystem()->directory(PATH_PROJECT . '/entries')->delete();
});

test('actions expression', function () {
    actions()->set('foo', 'Foo');
    entries()->create('actions', ['test' => '[[ actions().get("foo") ]]']);
    expect(entries()->fetch('actions')['test'])->toBe('Foo');
});