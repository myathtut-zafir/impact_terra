<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use SteveNay\MyanFont\MyanFont;

class LanguageController extends Controller
{
    public function handleZawgyiLanguageChosen($bot)
    {
        $this->handleLanguageChosen($bot, 'zaw');
    }

    public function handleUnicodeLanguageChosen($bot)
    {
        $this->handleLanguageChosen($bot, 'uni');
    }

    public function handleEnglishLanguageChosen($bot)
    {
        $this->handleLanguageChosen($bot, 'eng');
    }

    public function handleLanguageOption($bot)
    {
        if (IsBotInStopState($bot))
            return;

        $person = getCurrentPerson($bot);

        // reply language options
        $bot->reply(ButtonTemplate::create("Hello $person->full_name. \n\nPlease choose the convenient language.")
            ->addButton(ElementButton::create('English')->type('postback')->payload('language_english'))
            ->addButton(ElementButton::create('ျမန္မာ (ေဇာ္ဂ်ီ)')->type('postback')->payload('language_zawgyi'))
            ->addButton(ElementButton::create('မြန်မာ (ယူနီကုဒ်)')->type('postback')->payload('language_unicode')));
    }

    /**
     * if the user choose one language between english, zawgyi, or unicode
     */
    public function handleLanguageChosen($bot, $lan)
    {
        if ($user = getCurrentPerson($bot)) {
            $user->language = $lan;
            $user->save();

            config(['bot.user_language' => $user->language]);
        }

        $generalController = app('App\Http\Controllers\Bot\GeneralController');
        $generalController->handleIntroduction($bot);
    }

    public function decideLanguage(String $message)
    {
        $lan = "";

        // check by english words
        if (strpos($message, 'zawgyi') !== false)
            $lan = "zaw";
        else if (strpos($message, 'unicode') !== false)
            $lan = "uni";

        // check by burmese words
        if (empty($lan))
            $lan = MyanFont::fontDetectByMachineLearning($message, 'zaw') ?? 'eng';

        return substr($lan, 0, 3);
    }
}
