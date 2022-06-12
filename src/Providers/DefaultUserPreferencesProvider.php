<?php

namespace FoF\DefaultUserPreferences\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use Illuminate\Support\Collection;

class DefaultUserPreferencesProvider extends AbstractServiceProvider
{
    public function boot()
    {
        $this->container->singleton('fof-default-user-preferences', function (): array {
            return [
                'postMentioned' => true,
                'userMentioned' => true,
                'followAfterReply' => true,
            ];
        });

        $this->container->extend('flarum.settings.default', function (Collection $defaults) {
            /** @var array $registeredDefaults */
            $registeredDefaults = resolve('fof-default-user-preferences');

            foreach ($registeredDefaults as $key => $value) {
                if ($defaults->has("fof-default-user-preferences.$key")) {
                    throw new \RuntimeException("Cannot modify immutable default setting $key.");
                }

                $defaults->put("fof-default-user-preferences.$key", $value);
            }

            return $defaults;
        });
    }
}
