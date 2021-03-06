<?php
/**
 * Created by PhpStorm.
 * User: Azhe
 * Date: 28/10/2018
 * Time: 14.19
 */

namespace Longman\TelegramBot\Commands\UserCommands;


use App\Terjemah;
use App\Waktu;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class TrCommand extends UserCommand
{

    /**
     * Execute command
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $pecah = explode(' ', $message->getText());
        $repMssg = $message->getReplyToMessage();

        $time = $message->getDate();
        $time1 = Waktu::jedaNew($time);

        $tr_data = Terjemah::Exe($repMssg->getText(), $pecah[1], $pecah[2]);
        $text = '<b>Translate from</b> <code>' . $tr_data['from'] . '</code> <b>to</b> <code>' . $tr_data['to'] . "</code>\n";
        $text .= '<code>' . $tr_data['text'] . '</code>';

        $time2 = Waktu::jedaNew($time);
        $time = "\n\n ⏱ " . $time1 . ' | ⏳ ' . $time2;
        $data = [
            'chat_id' => $chat_id,
            'text' => $text . $time,
            'reply_to_message_id' => $repMssg->getMessageId(),
            'parse_mode' => 'HTML'
        ];

        return Request::sendMessage($data);
    }
}
