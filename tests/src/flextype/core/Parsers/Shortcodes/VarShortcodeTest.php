<?php

declare(strict_types=1);

beforeEach(function() {
    filesystem()->directory(FLEXTYPE_PATH_PROJECT . '/entries')->ensureExists(0755, true);
});

afterEach(function () {
    filesystem()->directory(FLEXTYPE_PATH_PROJECT . '/entries')->delete();
});

test('var shortcode', function () {
    expect(entries()->create('foo', ['vars' => ['foo' => 'Foo'], 'title' => '(var:foo) (var get:foo)']))->toBeTrue();
    expect(entries()->fetch('foo')['title'])->toBe('Foo Foo');

    expect(entries()->create('bar', ['title' => '(var set:bar value:Bar)(var:bar)']))->toBeTrue();
    expect(entries()->fetch('bar')['title'])->toBe('Bar');

    expect(entries()->create('zed', ['title' => '(var set:zed)Zed(/var)(var:zed)']))->toBeTrue();
    expect(entries()->fetch('zed')['title'])->toBe('Zed');
});

test('var shortcode disabled', function () {
    registry()->set('flextype.settings.parsers.shortcodes.shortcodes.var.enabled', false);
    expect(parsers()->shortcodes()->parse("(var set:bar value:Bar)"))->toBe('');
    registry()->set('flextype.settings.parsers.shortcodes.shortcodes.var.enabled', true);
});