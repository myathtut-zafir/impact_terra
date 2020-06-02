<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Utils\MessageInfo;
use App\Utils\MessengerUtility;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use SteveNay\MyanFont\MyanFont;

class FallbackController extends Controller
{
    public function handleFallback($bot)
    {
        $message = $bot->getMessage()->getText();
        Log::debug($message);

        try {
            $witResponse = $this->calltoWit($message);
            $nlg = new ResponseProcessor($witResponse);
            $this->replyFromResponse($bot, $nlg->getResponse());

        } catch (RequestException $e) {
            Log::debug($e->getMessage());
            $bot->reply("Something went wrong.");
        }

    }

    public function replyFromResponse($bot, $response)
    {
        if (empty($response) || $response["confidence"] < 0.8) {
            return;
        }

        // if Wit has answer
        switch ($response["type"]) {
            case "text":
                $bot->reply($response["response"]);
                break;
            case "go_block":
                $messageInfo = new MessageInfo;
                $messageInfo->language = MessengerUtility::setChosenLanguage($bot);;
                $block = Block::with(['messages.buttons', 'messages.genericTemplates'])
                    ->where('id', $response["response"])
                    ->first();

                MessengerUtility::replyMessengerFromBlock($bot, $block, $messageInfo);
                break;
            case "conversation":
                // TODO Exception Handling
                $conversation = resolve("\App\Conversations\\" . $response["response"]);
                $bot->startConversation($conversation);
                break;
        }
    }

    /**
     * @param $message
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * Make network call to Wit.ai
     */
    public function callToWit($message)
    {
        // convert message to uni first
        // because wit.ai model is trained by Unicode Encoding
        if (MyanFont::fontDetect($message) === "zawgyi") {
            $message = MyanFont::zg2uni($message);
        }

        $client = new Client([
            'base_uri' => 'https://api.wit.ai',
            'timeout' => 300.0,
        ]);

        // Call Rest api
        // Http Variables, Add-on Path, Headers Variables
        // and Query Variables
        $response = $client->request('GET', 'message', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer MCUM4CGXMPOAGORWRTGYQXQZKDSKIX64',
            ],
            'query' => [
                'v' => '20190609',
                'q' => $message,
            ]
        ]);

        // convert response to object
        $witResponse = \GuzzleHttp\json_decode($response->getBody());
//        Log::debug($witResponse);
        return $witResponse;
    }

    /**
     * @param BotMan $bot
     *
     * To handle the messages that Wit.ai also don't understand to resolve
     */
    public function replyDontUnderstand($bot)
    {
//        $bot->reply("ဟုတ");
//        $bot->reply(ButtonTemplate::create('UCSY က Admin ကိုႀကီး၊ မႀကီးေတြနဲ႔ ေျပာလို႔ ရပါတယ္။ 😃')
//            ->addButton(ElementButton::create('👦 Admin နဲ႔ ေျပာမယ္')->type('postback')->payload('chat_with_admin'))
//        );
    }
}
