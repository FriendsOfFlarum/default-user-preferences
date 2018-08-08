<?php

namespace PT\Preferences\Listeners;

use Flarum\Core\Notification\NotificationSyncer;
use Flarum\Core\User;
use Flarum\Event\UserWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;

class BeforeUserWillBeSaved
{
    const USER_PREFERENCES = [
        "notify_postMentioned_email" => true,
	    "notify_userMentioned_email" => true
    ];

    /**
     * @var NotificationSyncer
     */
    protected $notifications;

    /**
     * @param NotificationSyncer $notifications
     */
    public function __construct(NotificationSyncer $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(UserWillBeSaved::class, [$this, 'beforeUserWillBeSaved']);
    }

    /**
     * @param UserWillBeSaved $event
     */
    public function beforeUserWillBeSaved(UserWillBeSaved $event)
    {
        /** @var User $user */
        $user = $event->user;

        foreach(self::USER_PREFERENCES as $key => $value) {
            $user->setPreference($key, $value);
        }
    }
}
