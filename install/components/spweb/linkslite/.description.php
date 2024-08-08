<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
	$arComponentDescription = array(
		"NAME" => "Перелинковка (быстрые ссылки) LITE",
		"DESCRIPTION" => "Компонент для вывода быстрых ссылок",
		"PATH" => array(
			"ID" => "spweb",
			'NAME' => 'Spectre',
			"CHILD" => array(
				"ID" => "seo",
				"NAME" => "SEO",
			)
		),
	);
?>