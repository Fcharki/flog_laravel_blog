<?php

namespace App\Support;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

final class PostHtmlSanitizer
{
    private static ?HtmlSanitizer $sanitizer = null;

    /**
     * Sanitize user supplied rich-text HTML while keeping the markup produced
     * by the editor (headings, lists, links, images, tables, ...).
     */
    public static function clean(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        return self::sanitizer()->sanitize($html);
    }

    private static function sanitizer(): HtmlSanitizer
    {
        return self::$sanitizer ??= new HtmlSanitizer(
            (new HtmlSanitizerConfig)
                ->allowSafeElements()
                ->allowAttribute('class', allowedElements: '*')
                ->allowLinkSchemes(['http', 'https', 'mailto'])
                ->allowMediaSchemes(['http', 'https'])
                ->withMaxInputLength(1_000_000)
        );
    }
}
