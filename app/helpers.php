<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('image_url')) {
    /**
     * Resolve a stored image path into a usable URL.
     *
     * Full external URLs (http/https) are returned as-is, while local
     * paths are resolved through the public storage disk.
     */
    function image_url(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return Storage::url($path);
    }
}