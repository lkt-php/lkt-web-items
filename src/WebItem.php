<?php

namespace Lkt\WebItems;

class WebItem
{
    protected static array $WEB_ITEMS = [];

    public function __construct(readonly public string $component)
    {
    }

    public static function define(string $component): static
    {
        return new static($component);
    }

    public static function register(self $webItem): void
    {
        static::$WEB_ITEMS[$webItem->component] = $webItem;
    }

    public static function defineAndRegister(string $component): static
    {
        $ins = static::define($component);
        static::register($ins);
        return $ins;
    }
}