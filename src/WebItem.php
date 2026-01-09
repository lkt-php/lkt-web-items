<?php

namespace Lkt\WebItems;

use Lkt\WebItems\Enums\WebItemAction;

class WebItem
{
    protected static array $WEB_ITEMS = [];

    /** @var WebItemAction[] */
    protected $enabledAppActions = [];

    /** @var WebItemAction[] */
    protected $enabledAdminActions = [];

    public function __construct(
        readonly public string $component,
        readonly public string|null $publicComponentName = null,
    )
    {}

    /** @param WebItemAction[] $actions */
    public function setEnabledAppActions(array $actions): static
    {
        $this->enabledAppActions = $actions;
        return $this;
    }

    /** @param WebItemAction[] $actions */
    public function setEnabledAdminActions(array $actions): static
    {
        $this->enabledAdminActions = $actions;
        return $this;
    }

    public function getEnabledAppActions(): array
    {
        return $this->enabledAppActions;
    }

    public function getEnabledAdminActions(): array
    {
        return $this->enabledAdminActions;
    }

    public static function define(string $component, string|null $publicComponentName = null): static
    {
        return new static($component, $publicComponentName);
    }

    public static function register(self $webItem): void
    {
        static::$WEB_ITEMS[$webItem->component] = $webItem;
    }

    public static function defineAndRegister(string $component, string|null $publicComponentName = null): static
    {
        $ins = static::define($component, $publicComponentName);
        static::register($ins);
        return $ins;
    }

    public static function detectWebItem(string $component):?static
    {
        if (isset(static::$WEB_ITEMS[$component])) return static::$WEB_ITEMS[$component];

        $filtered = array_filter(static::$WEB_ITEMS, function (WebItem $item) use ($component) {
            return $item->publicComponentName === $component;
        });

        if (count($filtered) > 0) {
            reset($filtered);
            return $filtered[0];
        }

        return null;
    }

    public static function getAll(): array
    {
        return static::$WEB_ITEMS;
    }
}