<?php

// use App\Http\Controllers\Bot\GeneralController;
// use App\Http\Controllers\Bot\LanguageController;
// use App\Http\Controllers\FallbackController;
// use App\Http\Middleware\Bot\LanguageDecider;
// use App\Http\Middleware\Bot\MessageRecording;
// use App\Http\Middleware\Bot\UserRecording;
// use App\Models\AiRule;
// use App\Models\Button;
// use App\Models\QuickReply;
// use SteveNay\MyanFont\MyanFont;

// $botman = resolve('botman');

// $listenButtons = [];
// $listenQuickReplies = [];
// $botman->middleware->heard(new UserRecording());
// $botman->middleware->heard(new LanguageDecider());
// $botman->middleware->heard(new MessageRecording());

// // listening message buttons dynamically
// $buttons = Button::all();
// $aiRules = AiRule::all();
// $quickReplies = QuickReply::all();
// $delimiter = env('MESSAGE_DELIMITER', '___');

// foreach ($buttons as $button) {
//     // we only need to check EN version
//     // because we can assume if EN version is heard, the MM version will also be heard
//     // because they are the same record.
//     if (in_array($button->button_text_en, $listenButtons))
//         continue;

//     $botman->hears($button->button_text_en . "___" . $button->id, GeneralController::class . '@handleButtonText');

//     if ($button->button_text_mm !== $button->button_text_en)
//         $botman->hears($button->button_text_mm . "___" . $button->id, GeneralController::class . '@handleButtonText');

//     if ($button->button_text_mm !== MyanFont::uni2zg($button->button_text_mm))
//         $botman->hears(MyanFont::uni2zg($button->button_text_mm) . "___" . $button->id, GeneralController::class . '@handleButtonText');

//     $listenButtons[] = $button->button_text_en . "___" . $button->id;
// }

// //foreach ($aiRules as $aiRule) {
// //    // we only need to check EN version
// //    // because we can assume if EN version is heard, the MM version will also be heard
// //    // because they are the same record.
// //    if (in_array($aiRule->rule, $listenButtons))
// //        continue;
// //
// //    $botman->hears($aiRule->rule, GeneralController::class . '@handleAiRule');
// //    if (MyanFont::isMyanmarSar($aiRule->rule)) {
// //        $botman->hears(MyanFont::uni2zg($aiRule->rule), GeneralController::class . '@handleAiRule');
// //    }
// //
// //    $listenButtons[] = $aiRule->rule;
// //}

// foreach ($quickReplies as $quickReply) {
//     $listenQuickReplyText = $quickReply->id . $delimiter . $quickReply->search_keyword . $delimiter . $quickReply->payload;
//     if (in_array($listenQuickReplyText, $listenQuickReplies))
//         continue;

//     $botman->hears($listenQuickReplyText, GeneralController::class . '@handleQuickReply');
//     $listenQuickReplies[] = $listenQuickReplyText;
// }

// $botman->hears('GET_STARTED|Get Started|Language', LanguageController::class . "@handleLanguageOption");
// $botman->hears('^Hi$|^Help$|^Menu$|^Hello$|back_to_menu', GeneralController::class . '@handleIntroduction');

// // BotAdmin choose which font to use
// // Welcome Message
// $botman->hears('ျမန္မာ (ေဇာ္ဂ်ီ)|language_zawgyi', LanguageController::class . "@handleZawgyiLanguageChosen");
// $botman->hears('မြန်မာ|မြန်မာ (ယူနီကုဒ်)|language_unicode', LanguageController::class . "@handleUnicodeLanguageChosen");
// $botman->hears('language_english', LanguageController::class . "@handleEnglishLanguageChosen");

// fallback
//$botman->fallback(FallbackController::class.'@handleFallback');

