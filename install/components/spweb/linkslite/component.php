<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;


$hlblock = HL\HighloadBlockTable::getList([
            'filter' => ['=TABLE_NAME' => $arParams['LINKS_BLOCK']],
        ])->fetch();
if(!$hlblock){
    throw new \Exception('[04072017.1331.1]');
}
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();
$arResult = $entity_data_class::getList(array(
	'select' => array('*'),
	'order' => array('UF_SORT' => 'ASC'),
	'filter' => array('UF_URL' => $APPLICATION->GetCurPage())
))->FetchAll();

$this->IncludeComponentTemplate();

?>