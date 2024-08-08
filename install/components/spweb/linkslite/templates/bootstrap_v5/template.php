<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//$arResult
//$arParams
?>

<? if($arResult):?>
    <div class="row pt-3">
        <? foreach($arResult as $item): ?>
            <div class="col-auto mb-3"><a class="btn btn-outline-success" style="border-radius: 0" role="button" href="<?=$item['UF_LINK']?>"><span><?=$item['UF_NAME']?></span></a></div>
        <? endforeach; ?>
    </div>
<? endif; ?>

