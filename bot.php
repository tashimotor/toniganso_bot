<?php
include('vendor/autoload.php'); //Подключаем библиотеку
use Telegram\Bot\Api;

$telegram = new Api('599433038:AAGpVHldcOia5HAmparKV9AXFDJ4BVsHDXY'); //Устанавливаем токен, полученный у BotFather
$result   = $telegram->getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя

$text     = $result["message"]["text"]; //Текст сообщения
$chat_id  = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
$name     = $result["message"]["from"]["username"]; //Юзернейм пользователя
$keyboard = [["Позвонить"], ["Как доехать"], ["Мы в сети"], ['Услуги']]; //Клавиатура

if ($text)
{
	if ($text == "/start")
	{
		$reply        = "Привет, " . $name . ", используй кнопки, подписывайся на нас и будь всегда в теме в мире авто =)";
		$reply_markup = $telegram->replyKeyboardMarkup([
			'keyboard'          => $keyboard,
			'resize_keyboard'   => true,
			'one_time_keyboard' => false]);
		$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
	} elseif ($text == "/help")
	{
		$reply = "Информация с помощью.";
		$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
	} elseif ($text == "Позвонить")
	{
		$telegram->sendMessage(['chat_id' => $chat_id, 'text' => '+79259970047', 'reply_markup' => $reply_markup]);
	} elseif ($text == "Как доехать")
	{
		$telegram->sendLocation([
			'chat_id'      => $chat_id,
			'latitude'     => '55.575652',
			'longitude'    => '38.113608',
			'title'        => 'TonyGanso',
			'address'      => 'ул. Кооперативная, 3, Жуковский, Московская обл.',
			'reply_markup' => $reply_markup,
		]);
	} elseif ($text == "Мы в сети")
	{

		$telegram->sendMessage([
			'chat_id'      => $chat_id,
			'text'         => 'https://www.instagram.com/detailing_zhukovsky/?hl=ru',
			'reply_markup' => $reply_markup
		]);
		$telegram->sendMessage([
			'chat_id'      => $chat_id,
			'text'         => 'https://vk.com/tonyganso',
			'reply_markup' => $reply_markup
		]);
		$telegram->sendMessage([
			'chat_id'      => $chat_id,
			'text'         => 'https://tonyganso.ru',
			'reply_markup' => $reply_markup
		]);
	} else
	{
		$reply = "По запросу \"<b>" . $text . "</b>\" ничего не найдено.";
		$telegram->sendMessage(['chat_id' => $chat_id, 'parse_mode' => 'HTML', 'text' => $reply]);
	}
} else
{
	$telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}
?>