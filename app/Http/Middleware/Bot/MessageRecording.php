<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 4/18/2019
 * Time: 3:02 PM
 */

namespace App\Http\Middleware\Bot;

use App\Models\ReceivedMessage;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Heard;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use SteveNay\MyanFont\MyanFont;

class MessageRecording implements Heard
{
    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     * @throws \Exception
     */
    public function heard(IncomingMessage $message, $next, BotMan $bot)
    {
        $language = "eng";
        $unicode_message_text = $message->getText();

        if (MyanFont::isMyanmarSar($message->getText())) {
            $language = substr(MyanFont::fontDetectByMachineLearning($message->getText()), 0, 3);

            if ($language === 'zaw')
                $unicode_message_text = MyanFont::zg2uni($message->getText());
        }

        // check isPostBack button
        // Temporarily disabled
        //$payload = $message->getPayload();
        //$isPostBack = !empty($payload) && isset($payload['postback']);
        //if ($isPostBack) {
        //    Config::set("postback_message_language", $language);
        //}

        Config::set("bot.unicode_message_text", $unicode_message_text);

        $userId = $bot->getMessage()->getSender();
        ReceivedMessage::create([
            'language' => $language,
            'message' => $message->getText(),
            'user_messenger_id' => $userId
        ]);

        return $next($message);
    }
}