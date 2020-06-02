<?php

namespace App\Http\Controllers\Bot;

use App\Jobs\SendButtonResponse;
use App\Jobs\SendIntroduction;
use App\Jobs\SendQuickReplyResponse;
use App\Models\AiRule;
use App\Utils\MessageInfo;
use App\Utils\MessengerUtility;
use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GeneralController extends Controller
{
    public function handleIntroduction($bot)
    {
        // reply Introduction
        $bot->types();

        $language = MessengerUtility::retrieveChosenLanguage($bot);
        $messageInfo = new MessageInfo;
        $messageInfo->language = $language;

        $welcomeBlock = Block::with('messages.buttons')
            ->where('title', 'Welcome')
            ->first();

        MessengerUtility::replyMessengerFromBlock($bot, $welcomeBlock, $messageInfo);
    }

    public function handleAiRule($bot)
    {
        // reply based on Button Text
        if (IsBotInStopState($bot))
            return;

        $bot->types();

        $language = MessengerUtility::retrieveChosenLanguage($bot);
        $suffix = get_en_or_mm($language);

        $aiRule = AiRule::where('rule', strtolower(Config::get("bot.unicode_message_text")))->first();
        $aiRule->increment('tapped_count');

        $this->doButtonTask($aiRule, $language);

        return response("", 200);
    }

    public function handleButtonText($bot)
    {
        Log::debug("Handle Button Task " . Config::get('bot.unicode_message_text'));
        Log::info('button',['button_handle'=>"This is button fun"]);
        $bot->types();

        SendButtonResponse::dispatch($bot, Config::get('bot.unicode_message_text'),
            MessengerUtility::retrieveChosenLanguage($bot));

        return response("", 200);
    }

    public function handleQuickReply($bot)
    {
        $bot->types();

        SendQuickReplyResponse::dispatch($bot, Config::get('bot.unicode_message_text'),
            MessengerUtility::retrieveChosenLanguage($bot));

        return response("", 200);
    }
}
