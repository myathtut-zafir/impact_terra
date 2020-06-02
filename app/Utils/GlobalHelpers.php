<?php

use App\Models\Person;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use Carbon\Carbon;
use SteveNay\MyanFont\MyanFont;

function retrieveChosenLanguage($bot)
{
    $user_id = $bot->getMessage()->getSender();

    // Retrieve the chosen language
    if (!empty($user_id) &&
        $facebookUser = App\Models\Person::where('messenger_id', $user_id)->first()) {
        return $facebookUser->language;
    }

    return 'zaw';
}

function buildQuickMenuForMessenger(\Illuminate\Support\Collection $menus) {
    $quick_replies = $menus->map(function($menu, $key) {
        return [
            'content_type' => 'text',
            'title' => $menu,
            'payload' => $key,
        ];

    });

    return $quick_replies;
}

function activeFullUrl($fullUrl)
{
    // get only path from Full Url
    $path = parse_url($fullUrl, PHP_URL_PATH);
    $path = substr($path, 1);

    return request()->is($path);
}

function activePath($pathName)
{
    return (strpos(Request::path(), $pathName) !== false);
}

function getCurrentPerson($bot)
{
    $senderId = $bot->getMessage()->getSender();
    $person = Person::where('messenger_id', $senderId)->first();
    if ($person instanceof Person) {
        return $person;
    }

    return null;
}

function IsBotInStopState($bot)
{
    if ($currentUser = getCurrentPerson($bot)) {
        if (Cache::has($currentUser->fb_id)) {
            if ($bot->getDriver()->isPostback()) {

                $language = \App\Helper\MessengerUtility::retrieveChosenLanguage($bot);
                $text     = "";
                if ($language == "eng")
                    $text = "The chatbot is currently is in Stop State. You can type or click \"stop live chat\" to end admin chat session.";
                else {
                    $text = "လူကြီးမင်းက DVB admin တွေနဲ့ စကားပြောနေလို့ Chatbot ကို ခဏ ရပ်ထားပါတယ်။ Chatbot ကို ပြန်သုံးခြင်တယ်ဆိုရင် အောက်က \"stop live chat\" ခလုတ်လေးကို နှိပ်လိုက်ပါဗျ။";
                    if ($language == "zaw")
                        $text = MyanFont::uni2zg($text);
                }

                $buttonTemplate = ButtonTemplate::create($text)
                    ->addButton(ElementButton::create('Stop Live Chat')
                        ->type('postback')
                        ->payload('stop live chat'));

                $bot->reply($buttonTemplate);
            }

            return true;
        }

        return false;
    }
}

function youtube_id($url)
{
    if (strlen($url) > 11) {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        } else
            return false;
    }

    return $url;
}

function str_pad_left($input)
{
    return str_pad($input, 12, 0, STR_PAD_LEFT);
}

function encrypt_decrypt($action, $string)
{
    $output        = false;
    $encryptMethod = "AES-256-CBC";
    $secretKey     = env('ENCRYPTION_KEY');
    $secretIv      = env('IV');
    // hash
    $key = hash('sha256', $secretKey);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secretIv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encryptMethod, $key, 0, $iv);
        $output = base64_encode($output);

    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encryptMethod, $key, 0, $iv);

    }

    return $output;
}

function get_db_connection_based_on_lang($language) {
    $dbConnection = ($language == 'eng') ? 'dvb_news_en' : 'dvb_news_mm';

    return $dbConnection;
}

function get_en_or_mm($language) {
    if ($language === 'eng')
        return 'en';

    return 'mm';
}


function checkIsOfficeHours() {
    $start = '09:00:00';
    $end   = '18:00:00';
    $now   = Carbon::now('Asia/Yangon');
    $time  = $now->format('H:i:s');

    return ($time >= $start && $time <= $end);
}