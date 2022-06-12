<?php

/*
 * This file is part of fof/default-user-preferences.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\DefaultUserPreferences\Listeners;

use Flarum\User\Event\Registered;
use Flarum\User\User;
use Illuminate\Support\Str;

class ApplyDefaultPreferences
{
    public function handle(Registered $event)
    {
        /** @var array $defaults */
        $defaults = resolve('fof-default-user-preferences');

        foreach ($defaults as $key => $value) {
            if (Str::endsWith($key, 'Mentioned')) {
                $event->user->setPreference(
                    User::getNotificationPreferenceKey($key, 'email'),
                    $value
                );
            } else {
                $event->user->setPreference($key, $value);
            }
        }

        $event->user->save();
    }
}
