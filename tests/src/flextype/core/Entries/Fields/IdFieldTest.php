<?php

use Flextype\Component\Filesystem\Filesystem;

beforeEach(function() {
    filesystem()->directory(PATH_PROJECT . '/entries')->create();
});

afterEach(function (): void {
    filesystem()->directory(PATH_PROJECT . '/entries')->delete();
});

test('IdField', function () {
    entries()->create('foo', []);
    $id = entries()->fetch('foo')['id'];
    $this->assertEquals('foo', $id);

    entries()->create('foo/bar', []);
    $id = entries()->fetch('foo/bar')['id'];
    $this->assertEquals('foo/bar', $id);
});
