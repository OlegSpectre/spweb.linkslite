
//Prototype for load link

(function (window){
	'use strict';
	
	if (window.UrlLinkSPBootOwl)
		return;
	
	
	window.UrlLinkSPBootOwl = function (arParams)
	{
		this.id = '';
		this.url = '';
        this.ajax_url = '';
		this.owl = '';
        this.block_hl = '',
		this.errorCode= 0;
		this.linkmore = '';
        this.owl_carusel = 'owl-carousel',
		this.ajaxURL = '/bitrix/components/spweb/linkslite/ajax.php';
		if (typeof arParams === 'object')
		{
			this.id = arParams.ID;
			this.URL = arParams.URL;
            this.ajax_url = arParams.AJAX_URL;
			this.owl = arParams.CLASS;
			this.linkmore = arParams.LINKMORE;
            this.block_hl = arParams.BLOCK_HL;
            this.owl_carusel = arParams.OWL_CARUSEL;
		}
		
		if (this.errorCode === 0)
		{
			BX.ready(BX.delegate(this.init,this));
		}
		
	};
	
	window.UrlLinkSPBootOwl.prototype = {
		
		init: function()
		{
            this.loadlink(this.id, this.block_hl, this.URL, this.ajax_url);
		},
        
        loadlink: function(id, hl, url, ajax_url){
            var dataSend = {
                    hlblock: hl,
                    url: url
                }
            BX.showWait(BX(this.id));
            BX.ajax({
                  url: ajax_url,
                  data: dataSend,
                  method: 'POST',
                  dataType: 'json',
                  onsuccess: BX.delegate(function(data) {
                      if(data){
                          if(data.success != 'empty'){
                            this.inittemplate(data.success, this.id);
                            this.initOwlCarusel(this.id);
                          }
                          BX.closeWait(BX(this.id));
                      }
                  }, this),
                  onfailure: function(){}
              }); 
            
        },
        inittemplate: function(res, id){
            var spDivMain       = BX(id),
                owl_carusel     = this.owl_carusel,
                spDivRow        = BX.create('DIV', {props: {className: 'row'}}),
                spDivCol12      = BX.create('DIV', {props: {className: 'col-10'}}),
                spOwlContainer  = BX.create('DIV', {props: {className: owl_carusel+' owl-carousel owl-theme'}});
            
            spDivMain.appendChild(spDivRow);
            spDivRow.appendChild(spDivCol12);
            spDivCol12.appendChild(spOwlContainer);
            
            //container for reade more
            var cpReadMoreMain = BX.create('DIV', {props: {className: 'sp-link-readmore col-md-2'}});
            spDivRow.appendChild(cpReadMoreMain);
            
            var cpReadMoreMainP = BX.create('P',
                                            {props:
                                                { className: 'btn btn-secondary',
                                                  id: 'sp-link-readmore'
                                                },
                                             text: 'Развернуть',
                                             events: {
                                                 click: BX.proxy(this.linkmoreOpen, this)
                                             },
                                             attrs:{
                                                 'href': '#'
                                                    } });
            cpReadMoreMain.appendChild(cpReadMoreMainP);
            
            res.forEach(function(item, i, res) {
              
              spOwlContainer.appendChild(
                  BX.create('DIV',{
                        props: {className: "item"},
                        children: [
                             BX.create('a', {
                                  props: {className: "btn btn-outline-secondary"},
                                  attrs:{'href': item.UF_LINK},
                                  children: [
                                      BX.create('SPAN', {text: item.UF_NAME})
                                  ]
                              })
                        ]
                  })
              )
            });
        },
        
        initOwlCarusel: function(id){
            var owlThis = $('.'+this.owl_carusel);
			owlThis.owlCarousel({
				nav:true,
				autoWidth: true,
				dots: false,
				navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			});
        },
        
		linkmoreOpen: function(){
			var target = BX.proxy_context; 
			
			if(BX.hasClass(target, 'active')){
				this.initOwlCarusel(this.id);
				BX.removeClass(target, 'active');
				BX.adjust(BX(target), {text: 'Развернуть'});
			}else{
				$('.'+this.owl_carusel).trigger('destroy.owl.carousel');
				$('.'+this.owl_carusel).find('.owl-stage-outer').children().unwrap();
				BX.addClass(target, 'active');
				BX.adjust(BX(target), {text: 'Свернуть'});
			}
		}


	};
	
})(window);


