<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//$arResult
//$arParams

$id_comp = 'sp'.uniqid();
$this->setFrameMode(true);
?>


<div id="<?=$id_comp?>">
</div>


<script type="text/javascript">
    var <?=$id_comp?> = new UrlLinkSPBoot({
                                "AJAX_URL": '<?=$componentPath?>/ajax.php',
                                "BLOCK_HL": '<?=$arParams['LINKS_BLOCK']?>',
                                "ID" : '<?=$id_comp?>',
                                "LINKMORE": '',
                                "CLASS": "row pt-3",
                                "URL": '<?=$APPLICATION->GetCurPage()?>'
                                });
</script>
