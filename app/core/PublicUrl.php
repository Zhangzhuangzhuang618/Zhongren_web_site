<?php
namespace app\core;

final class PublicUrl
{
    // Only known public aliases. Category, asset, API and admin URLs are untouched.
    private const CANONICAL = [
        '/index' => '/',
        '/index.html' => '/',
        '/pricing' => '/pricing.html',
        '/pricing.html' => '/pricing.html',
        '/faq' => '/faq.html',
        '/faq.html' => '/faq.html',
        '/products' => '/products/2.html',
        '/products.html' => '/products/2.html',
        '/products/2.html' => '/products/2.html',
        '/cases' => '/cases/6.html',
        '/cases.html' => '/cases/6.html',
        '/cases/6.html' => '/cases/6.html',
        '/news' => '/news.html',
        '/news/7' => '/news.html',
        '/news/7.html' => '/news.html',
        '/news.html' => '/news.html',
        '/about/18' => '/contact/8.html',
        '/about/18.html' => '/contact/8.html',
        '/contact' => '/contact/8.html',
        '/contact.html' => '/contact/8.html',
        '/contact/8.html' => '/contact/8.html',
    ];

    /** Preserve query strings and fragments on internal links. */
    public static function canonicalize(string $url): string
    {
        $pathLength = strcspn($url, '?#');
        $path = rtrim(substr($url, 0, $pathLength), '/');
        return isset(self::CANONICAL[$path])
            ? self::CANONICAL[$path] . substr($url, $pathLength)
            : $url;
    }
}
