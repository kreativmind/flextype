<?php

declare(strict_types=1);

 /**
 * Flextype - Hybrid Content Management System with the freedom of a headless CMS 
 * and with the full functionality of a traditional CMS!
 * 
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

emitter()->addListener('onEntriesFetchSingleHasResult', static function (): void {

    if (! entries()->registry()->get('methods.fetch.collection.fields.slug.enabled')) {
        return;
    }

    if (entries()->registry()->get('methods.fetch.result.slug') !== null) {
        return;
    }

    $parts = explode('/', ltrim(rtrim(entries()->registry()->get('methods.fetch.params.id'), '/'), '/'));
    entries()->registry()->set('methods.fetch.result.slug', (string) end($parts));
});
