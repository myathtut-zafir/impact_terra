<?php

namespace App\Http\Middleware\Bot;

use App\Models\Person;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Heard;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class UserRecording implements Heard
{
    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMan $bot)
    {
        $senderId = $bot->getMessage()->getSender();
        $userAlreadyExisted = Person::where('messenger_id', $senderId)->exists();

        if (!$userAlreadyExisted) {
            $user = $bot->getUser();

            // if we can get the user from the incoming message,
            // we saved it.
            if ($user instanceof \BotMan\Drivers\Facebook\Extensions\User) {
                Person::createFromIncomingMessage($user);
            }
        }

        return $next($message);
    }
}