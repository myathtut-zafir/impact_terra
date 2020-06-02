<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Jobs\SendHandleChatWithAPerson;
//use App\Utilities\LanguageOption;
//use App\Utilities\MessengerUtility;
use Illuminate\Support\Facades\Log;

class HumanHandoverController extends Controller
{
    public function handleChatWithAPerson($bot)
    {
        Log::debug("Chat with a person");
        $bot->types();

        $language = \App\Utils\MessengerUtility::retrieveChosenLanguage($bot);
        SendHandleChatWithAPerson::dispatch($bot, $language);

        return response("", 200);
    }
}