<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//$arResult
//$arParams
$this->setFrameMode(true);
?>

<? if($arResult):?>
    <div class="sp-link-outer">
        <? foreach($arResult as $item): ?>
            <a class="sp-link-link" href="<?=$item['UF_LINK']?>"><span><?=$item['UF_NAME']?></span></a> 
        <? endforeach; ?>
    </div>
<? endif; ?>
