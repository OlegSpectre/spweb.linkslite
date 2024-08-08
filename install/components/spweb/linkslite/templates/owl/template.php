<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//$arResult
//$arParams
$this->setFrameMode(true);
?>

<? if($arResult):?>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <div class="sp-link-outer row">
        <div class="col-md-10">
            <div class="sp-link-container owl-carousel owl-theme">
                <? foreach($arResult as $item): ?>
                    <div class="item">
                        <a class="sp-link-link" href="<?=$item['UF_LINK']?>"><span><?=$item['UF_NAME']?></span></a>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="sp-link-readmore col-md-2">
            <p id="sp-link-readmore" class="btn btn-secondary" href="#">Развернуть</p>
        </div>
    </div>
    

    <script>
        var owlThis = $('.sp-link-container');
        function initOwlSpLinks(){
            owlThis.owlCarousel({
                nav:true,
                autoWidth: true,
                dots: false,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            });
        }
        initOwlSpLinks();
        BX.bind(
            BX('sp-link-readmore'), 'click',
            function(el){
                var target = el.target.id;
                if(BX.hasClass(target, 'active')){
                    initOwlSpLinks();
                    BX.removeClass(target, 'active');
                    BX.adjust(BX(target), {text: 'Развернуть'});
                }else{
                    owlThis.trigger('destroy.owl.carousel');
                    owlThis.find('.owl-stage-outer').children().unwrap();
                    BX.addClass(target, 'active');
                    BX.adjust(BX(target), {text: 'Свернуть'});
                }
            }
        )

        
    </script>

<? endif; ?>

