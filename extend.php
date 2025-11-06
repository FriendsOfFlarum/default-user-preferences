<?php

/*
 * This file is part of fof/default-user-preferences.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\DefaultUserPreferences;

use Flarum\Api\Context;
use Flarum\Api\Resource\ForumResource;
use Flarum\Api\Schema;
use Flarum\Extend;
use Flarum\User\Event\Registered;
use FoF\DefaultUserPreferences\Providers\DefaultUserPreferencesProvider;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Event())
        ->listen(Registered::class, Listeners\ApplyDefaultPreferences::class),

    (new Extend\ServiceProvider())
        ->register(DefaultUserPreferencesProvider::class),

    (new Extend\ApiResource(ForumResource::class))
        ->fields(fn () => [
            Schema\Arr::make('fof-default-user-preferences')
                ->get(fn () => resolve('fof-default-user-preferences'))
                ->visible(fn ($model, Context $context) => $context->getActor()->isAdmin()),
        ]),
];
