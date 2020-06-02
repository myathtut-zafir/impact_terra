<?php

namespace App\Utils;

use App\EventDto;
use App\Models\Block;
use App\Models\Person;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use SteveNay\MyanFont\MyanFont;

// This class is responsible for responding with
// Facebook Template when given the App data.
//
// Currently I developed this class Static Utility Class

/**
 * Author: NayLinAung
 *
 * Class MessengerUtility
 * @package App\Traits
 */
class MessengerUtility
{
    static $fail = "fail";
    static $normal = "normal";

    public static function setChosenLanguage($bot)
    {
        $person = getCurrentPerson($bot);
        if ($person) {
            Log::debug("Set person chosen language: (fb_id) " . $person->messenger_id . " ($person->full_name) : " . $person->language);
            config(['bot.user_language' => $person->language]);
        }
    }

    public static function retrieveChosenLanguage($bot)
    {
        // deprecated
        /* $language = Config::get('postback_message_language');

         if (!empty($language))
             return $language;*/

        $language = Config::get('bot.user_language', 'zaw');

        return $language;
    }

    public static function replyInBurmese($bot, $englishText, $burmeseText)
    {
        $language = self::retrieveChosenLanguage($bot);
        if ($language == "eng")
            $bot->reply($englishText);
        else {
            $value = $burmeseText;
            if ($language == "zaw")
                $value = MyanFont::uni2zg($value);
            $bot->reply($value);
        }
    }

    public static function replyFailure(BotMan $bot, string $message)
    {
        if (empty($message)) {
            $block = Block::with('messages.buttons')->where('title', 'General Failed Message')->first();
            if ($block instanceof Block) {
                MessengerUtility::replyMessengerFromBlock($bot, $block, self::$normal);
            }
        } else {
            $bot->reply($message);
        }
    }

    public static function replyMessageFromTemplate(BotMan $bot, $template = null, MessageInfo $messageInfo = null)
    {
        // set default messageInfo object
        $messageInfo = ($messageInfo === null) ? new MessageInfo : $messageInfo;

        // Check block not null
        if ($template == null || empty($template)) {
            self::replyFailure($bot);
            return;
        }

        $reply = self::buildOneGenericTemplate($bot, $template, $messageInfo);
        $bot->reply($reply);
    }

    public static function replyMessageFromMessage(BotMan $bot, $message = null, MessageInfo $messageInfo = null)
    {
        // set default messageInfo object
        $messageInfo = ($messageInfo === null) ? new MessageInfo : $messageInfo;

        // Check block not null
        if ($message == null || empty($message)) {
            self::replyFailure($bot);
            return;
        }

        self::sendMessage($bot, $message, $messageInfo);
    }

    /**
     * All the content are stored in database as Block
     * The block is general data type.
     * This method tries to build fb messenger message from this Block.
     *
     * @param BotMan $bot
     * @param null $block
     */
    public static function replyMessengerFromBlock(BotMan $bot, $block = null, MessageInfo $messageInfo = null)
    {
        // set default messageInfo object
        $messageInfo = ($messageInfo === null) ? new MessageInfo : $messageInfo;

        // Check block not null
        if ($block == null || empty($block)) {
            self::replyFailure($bot);
            return;
        }

        if (is_null($block->messages()->first())) {
            self::replyFailure($bot);
            return;
        }

        // check Fail Message or Normal Message to show
        $isNormal = $messageInfo->forCondition === self::$normal;
        $messages = $block->messages->filter(function ($message) use ($isNormal) {
            $failInclude = stristr($message->title, 'Failed:') !== false;

            return ($isNormal) ? !$failInclude : $failInclude;
        });
        $messages = $messages->sortBy('sequence_number')->all();

        foreach ($messages as $message) {
            self::sendMessage($bot, $message, $messageInfo);
        }
    }

    public static function sendMessage($bot, $message, $messageInfo)
    {
        $message->increment('sent_count');

        if ($message->category == 'function') {
            // function call message
            $reply = self::buildFunctionCall($bot, $message->translated_message_text, $messageInfo);
            return;

        } else if (count($message->buttons) > 0) {
            $reply = self::buildButtonTemplate($bot, $message);

        } else if ($message->category == 'image') {
            // image attachment message
            $attachment = new Image($message->translated_message_text);
            $reply = OutgoingMessage::create('')->withAttachment($attachment);

        } else if ($message->category == 'template') {
            $reply = self::buildGenericTemplate($bot, $message, $messageInfo);

        } else if ($message->category == 'text' and !empty($message->translated_message_text)) {
            $reply = self::replacePlaceholder($bot, $message->translated_message_text, $messageInfo->additionalParams);

        } else if ($message->category == 'function_text' and isset($additionalParams['from_function'])) {
            $reply = self::replacePlaceholder($bot, $message->translated_message_text, $messageInfo->additionalParams);

        }

        // only if we've build the reply object
        if (isset($reply) && $reply !== null) {
            $hasQuickReplies = (count($message->quickReplies) > 0);
            $hasMessageQuickReplies = (strpos($message->message_text, "quick_replies") !== false && array_key_exists("quick_replies", $messageInfo->additionalParams));

            if ($hasQuickReplies || $hasMessageQuickReplies) {
                $quickReplies = $hasQuickReplies ? self::buildQuickReplies($message->quickReplies->all())
                    : $messageInfo->additionalParams["quick_replies"];

                // attach message with quick reply
                $bot->reply($reply, ['message' => [
                    'quick_replies' => $quickReplies
                ]]);

            } else {
                $bot->reply($reply);
            }
        }
    }

    /**
     * Replace placeholder like usernames
     *
     * @param $bot
     * @param string $text
     * @return mixed|string
     */
    public static function replacePlaceholder($bot, string $text, array $additionalParams = [])
    {
        if (strpos($text, '{{username}}') !== false) {

            $user_name = ($bot->getUser()) ? $bot->getUser()->getFirstName() : "buddy";
            $language = self::retrieveChosenLanguage($bot);
            if ($language !== "eng") {
                $user_name = "";
            }
            $text = str_replace('{{username}}', $user_name, $text);
        }

        if (count($additionalParams) > 0) {
            foreach ($additionalParams as $key => $value) {
                if (strpos($text, '{{' . $key . '}}') !== false) {
                    if (is_string($value))
                        $text = str_replace('{{' . $key . '}}', $value, $text);
                }
            }
        }

        // remove unfound placeholders
        $text = preg_replace('/{{[\s\S]+?}}/', '', $text);

        return $text;
    }

    /**
     * Function Call to Custom Controller Methods
     *
     * @param $bot
     * @param $message
     * @param $messageInfo
     * @return mixed
     */
    public static function buildFunctionCall($bot, $function, $messageInfo)
    {
        $chunks = explode("::", $function);
        $controllerName = $chunks[0];
        $functionName = $chunks[1];
        $controller = resolve("App\Http\Controllers\Bot\\" . $controllerName);

        if (!empty($messageInfo->payload))
            $controller->$functionName($bot, $messageInfo->payload);
        else
            $controller->$functionName($bot);

        return true;
    }

    /**
     * Build Messsenger Button Template and return it
     *
     * @param $bot
     * @param $message
     * @return ButtonTemplate
     */
    public static function buildButtonTemplate($bot, $message)
    {
        // button template message
        $reply = ButtonTemplate::create(self::replacePlaceholder($bot, $message->translated_message_text));
        $buttons = $message->buttons->sortBy('sequence')->all();
        $personId = self::getPersonId($bot);
        foreach ($buttons as $button) {
            $fbButton = self::buildButton($button, $personId);
            $reply->addButton($fbButton);
        }

//        $reply->addQuickReplies($quick_replies);

        return $reply;
    }

    public static function buildButton($button, $personId = 0)
    {
        $fbButton = ElementButton::create($button->translated_button_text);
        switch ($button->category) {
            case 'url':
                $fbButton
                    ->url($button->url . "?language=" . self::personChoosenLanguage($personId))
                    ->heightRatio(ElementButton::RATIO_FULL);

                if (strpos($button->url, "https://dugro.digitxmyanmar.com/") !== false)
                    $fbButton->enableExtensions();

                break;
            case 'share':
                Log::debug($button->translated_button_text);
                $fbButton
                    ->type(ElementButton::TYPE_SHARE);
                break;
            case 'phone_number':
                $fbButton
                    ->type('phone_number')
                    ->payload($button->phone);
                break;
            case 'go_block':
            default:
                $fbButton
                    ->type('postback')
                    ->payload($button->translated_button_text . '___' . $button->id);
                break;
        }

        return $fbButton;
    }

    /**
     * Build Messsenger Button Template and return it
     *
     * @param $bot
     * @param $message
     * @return ButtonTemplate
     */
    public static function buildGenericTemplate($bot, $message)
    {
        // button template message
        $reply = GenericTemplate::create()->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);

        // Create each template model object into Messenger Generic Template Element
        $elements = $message->genericTemplates->sortBy('id')->map(function ($item, $key) {
            // build FbElement from event
            return self::buildElement($item);
        });

        $reply->addElements($elements->toArray());

        Log::debug($elements->toArray());

        return $reply;
    }

    /**
     * Build Messsenger Button Template and return it
     *
     * @param $bot
     * @param $message
     * @return ButtonTemplate
     */
    public static function buildOneGenericTemplate($bot, $template)
    {
        // button template message
        $reply = GenericTemplate::create()->addImageAspectRatio(GenericTemplate::RATIO_HORIZONTAL);

        // Create each template model object into Messenger Generic Template Element
        $elements[] = self::buildElement($template);

        $reply->addElements($elements);

        Log::debug($elements);

        return $reply;
    }

    /**
     * Create Quick Replies Template for
     * each Event Category.
     *
     * @param array $categories
     * @return array
     */
    public static function buildCategoriesQuickReplies(array $categories)
    {

        $quick_replies = array_map(function ($category) {
            return [
                'content_type' => 'text',
                'title' => $category,
                'payload' => 'search by category ' . $category,
            ];

        }, $categories);

        return $quick_replies;
    }

    public static function buildQuickReplies(array $quickReplies)
    {
        $delimiter = env('MESSAGE_DELIMITER', '___');
        $quick_replies = array_map(function ($quickReply) use ($delimiter) {
            return [
                'content_type' => 'text',
                'title' => $quickReply->translated_button_text,
                'payload' => $quickReply->id . $delimiter . $quickReply->search_keyword . $delimiter . $quickReply->payload,
            ];

        }, $quickReplies);

        return $quick_replies;
    }

    /**
     * @param EventDto $events array
     * @param String $eventType
     * @return Array
     */
    public static function buildEventTemplate(EventDto $events, String $eventType): Array
    {
        // Create each recipe into Facebook Generic Template Element
        $fbElements = $events->getItems()->map(function ($item, $key) {
            // build FbElement from event
            return self::buildFbElementForEvent($item);
        });

        if ($events->hasMorePages()) {
            // add more events card
            $fbElements[] = self::buildFbElementForMoreEvent($events->getCurrentPage(), $eventType);
        }

        return $fbElements->toArray();
    }

    /**
     * Create Quick Replies for "more events"
     *
     * @param EventDto $events
     * @param String $title
     * @param String $eventType
     * @return Array
     */
    public static function buildMoreEventQuickReply(EventDto $events, String $title, String $eventType): Array
    {
        $quickReplies = [];
        if ($events->hasMorePages()) {
            $curPage = $events->getCurrentPage() + 1;
            $quickReplies[] = [
                'content_type' => 'text',
                'title' => $title,
                'payload' => "$eventType " . $curPage,
            ];
        }

        return $quickReplies;
    }

    /**
     * Create Facebook Element for each Event
     * to be inserted into the Event Generic Template
     *
     * @param $event
     * @return $this
     */
    public static function buildElement($template)
    {

        // create element for each event
        $element = Element::create($template->title)
            ->image($template->cover_image_name)
            ->itemUrl($template->url);

        if (!empty($template->subtitle))
            $element->subtitle($template->subtitle);

        // add buttons
        $buttons = $template->buttons->sortBy('sequence')->all();
        foreach ($buttons as $button) {
            $element->addButton(self::buildButton($button));
        }

        return $element;

    }

    /**
     * Create Facebook Element for "more events" button
     *
     * @param int $currentPage
     * @param string $eventType
     * @return $this
     */
    public static function buildFbElementForMoreEvent(int $currentPage, string $eventType)
    {
        $currentPage += 1;

        // create element for each recipe
        return Element::create("Find More Events")
            ->image("https://statistic-cdn.myanpwel.com/img/ad-cover.jpg?62c983f58fe412fd450912d88d9d64a8")
            ->addButton(ElementButton::create('More events')
                ->payload("$eventType " . $currentPage)
                ->type('postback'));
    }

    /**
     * @param $bot
     * @param int $messengerId
     * @return int
     */
    private static function getPersonId($bot): int
    {
        $person = getCurrentPerson($bot);
        if ($person) {
            $personId = $person->id;
        } else {
            $personId = 0;
        }
        return $personId;
    }

    public static function personChoosenLanguage($personId)
    {
        if ($personId !== 0) {
            $person = Person::find($personId);
            return $person->language;
        }
        return Constant::UNI;
    }

}