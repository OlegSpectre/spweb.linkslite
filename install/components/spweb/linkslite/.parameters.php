<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$hllist = [];
use Bitrix\Highloadblock as HL;
CModule::IncludeModule('highloadblock');
$hlblock = HL\HighloadBlockTable::getList()->fetchAll();

foreach($hlblock as $hlData){
	$hllist[$hlData["TABLE_NAME"]] = $hlData["NAME"];
}
$arComponentParameters = array(
	'PARAMETERS' => array(
		'LINKS_BLOCK' => array(
			'TYPE' => 'LIST',
			'PARENT' => 'BASE',
			'VALUES' => $hllist,
			'NAME' => "Highload-блок c ссылками",
		),
		
		'CACHE_TIME' => array('DEFAULT' => 3600),

	),
);


?>