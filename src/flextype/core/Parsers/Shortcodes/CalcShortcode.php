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

namespace Flextype\Parsers\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;


use function Flextype\parsers;
use function Flextype\registry;

// Shortcode: calc
// Usage: (calc:2+2)
parsers()->shortcodes()->addHandler('calc', static function (ShortcodeInterface $s) {
    if (! registry()->get('flextype.settings.parsers.shortcodes.shortcodes.calc.enabled')) {
        return '';
    }

    return parsers()->expressions()->eval(parsers()->shortcodes()->parse($s->getBBCode()));
});
