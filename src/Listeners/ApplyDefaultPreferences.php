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

        foreach ($defaults as $data) {
            if (Str::endsWith($data['key'], 'Mentioned')) {
                $event->user->setPreference(
                    User::getNotificationPreferenceKey($data['key'], 'email'),
                    $data['value']
                );
            } else {
                $event->user->setPreference($data['key'], $data['value']);
            }
        }

        $event->user->save();
    }
}
