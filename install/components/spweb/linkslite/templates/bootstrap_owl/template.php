<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//$arResult
//$arParams

$id_comp = 'sp'.uniqid();
$this->setFrameMode(true);
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div id="<?=$id_comp?>" class="sp-link-outer">
</div>


<script type="text/javascript">
    var <?=$id_comp?> = new UrlLinkSPBootOwl({
                                "AJAX_URL": '<?=$componentPath?>/ajax.php',
                                "BLOCK_HL": '<?=$arParams['LINKS_BLOCK']?>',
                                "ID" : '<?=$id_comp?>',
                                "LINKMORE": 'sp-link-readmore',
                                "CLASS": "row pt-3",
                                "OWL_CARUSEL": "sp-link-container-owl",
                                "URL": '<?=$APPLICATION->GetCurPage()?>'
                                });
</script>
