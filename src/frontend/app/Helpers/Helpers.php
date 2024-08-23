<?php

namespace App\Helpers;

class Helpers
{
    public static function replacePaginationUrls(array $paginationData, string $newBaseUrl): array
    {
        // Reemplazar las URLs principales
        $paginationData['first_page_url'] = Helpers::replaceBaseUrl($paginationData['first_page_url'], $newBaseUrl);
        $paginationData['last_page_url'] = Helpers::replaceBaseUrl($paginationData['last_page_url'], $newBaseUrl);
        $paginationData['next_page_url'] = Helpers::replaceBaseUrl($paginationData['next_page_url'], $newBaseUrl);
        $paginationData['prev_page_url'] = Helpers::replaceBaseUrl($paginationData['prev_page_url'], $newBaseUrl);

        // Reemplazar las URLs en los links
        foreach ($paginationData['links'] as &$link) {
            if (!is_null($link['url'])) {
                $link['url'] = Helpers::replaceBaseUrl($link['url'], $newBaseUrl);
            }
        }

        return $paginationData;
    }

    public static function replaceBaseUrl($originalUrl, $newBaseUrl)
    {
        $parsedUrl = parse_url($originalUrl);
        $query = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';
        $newUrl = rtrim($newBaseUrl, '/') .  $query;

        return $newUrl;
    }
}
