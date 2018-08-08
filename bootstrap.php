<?php

namespace PT\Preferences;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;

return function(Dispatcher $events, Factory $views)
{
    $events->subscribe(Listeners\BeforeUserWillBeSaved::class);
};
