<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main;
use Bitrix\Highloadblock as HL;

CModule::IncludeModule('highloadblock');

//echo $APPLICATION->GetCurUri();

if($_REQUEST['url'] and $_REQUEST['hlblock']){
    
    $hlblock = HL\HighloadBlockTable::getList([
                'filter' => ['=TABLE_NAME' => $_REQUEST['hlblock']],
            ])->fetch();
    if(!$hlblock){
        throw new \Exception('[04072017.1331.1]');
    }
	$entity = HL\HighloadBlockTable::compileEntity($hlblock);
	$entityClass = $entity->getDataClass();
    $resR = $entityClass::getList(array(
       'select' => array('*'),
       'order' => array('UF_SORT' => 'ASC'),
       'filter' => array('UF_URL' => $_REQUEST['url'])
    ))->FetchAll();    
    if($resR){
       echo json_encode(['success' => $resR]); 
    }else{
       echo json_encode(['success' => 'empty']);  
    }
    
    
    ?><?
/*
?>

	<?
		

		
		$_arrResult = [];
		$count = 0;
 		while($arData = $resR->Fetch()){
			$_arrResult[$count]['NAME'] = $arData['UF_NAME'];
			$_arrResult[$count]['LINK'] = $arData['UF_LINK'];
			$count++;
		}
	if(count($_arrResult)>0){
		
	?>
	<div class="SpLink-outer">
		<div class="SpLink-slider">
			<div class="SpLinkContainer owl-carousel">
				<? foreach($_arrResult as $_item){ ?>
				<div class="item">
					<a class="btn btn-default" role="button" href="<?=$_item['LINK']?>"><?=$_item['NAME']?></a>
				</div>
				<? } ?>
			</div>
		</div>
		<div class="SpLink-readmore">
			Развернуть
		</div>
	</div>

<script>
	$('.SpLinkContainer').owlCarousel({
				loop:true,
				nav:true,
				autoWidth:true,
	});
</script>
<?	
	}
	//END load all links
*/
}

require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php"); ?>
