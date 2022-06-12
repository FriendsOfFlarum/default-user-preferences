<?php

/*
 * This file is part of fof/default-user-preferences.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\DefaultUserPreferences\Extend;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class RegisterUserPreferenceDefault implements ExtenderInterface
{
    protected $data = [];

    public function default(string $key, bool $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        $container->extend('fof-default-user-preferences', function ($items) {
            return array_merge($items, $this->data);
        });
    }
}
