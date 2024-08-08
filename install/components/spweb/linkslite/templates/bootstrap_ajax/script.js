//Prototype for load link

(function (window){
	'use strict';
	
	if (window.UrlLinkSPBoot)
		return;
	
	
	window.UrlLinkSPBoot = function (arParams)
	{
		this.id = '';
		this.url = '';
        this.ajax_url = '';
		this.owl = '';
        this.block_hl = '',
		this.errorCode= 0;
		this.linkmore = '';
		this.ajaxURL = '/bitrix/components/spweb/linkslite/ajax.php';
		if (typeof arParams === 'object')
		{
			this.id = arParams.ID;
			this.URL = arParams.URL;
            this.ajax_url = arParams.AJAX_URL;
			this.owl = arParams.CLASS;
			this.linkmore = arParams.LINKMORE;
            this.block_hl = arParams.BLOCK_HL;
		}
		
		if (this.errorCode === 0)
		{
			BX.ready(BX.delegate(this.init,this));
		}
		
	};
	
	window.UrlLinkSPBoot.prototype = {
		
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
                          }
                          BX.closeWait(BX(this.id));
                      }
                  }, this),
                  onfailure: function(){}
              }); 
            
        },
        inittemplate: function(res, id){
            var spDiv = BX(id);
            var spLink = BX.create('DIV', {props: {className: this.owl}});
            spDiv.appendChild(spLink);
            
            res.forEach(function(item, i, res) {
              
              spLink.appendChild(
                  BX.create('DIV',{
                        props: {className: "col-auto mb-3"},
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
        }


	};
	
})(window);

  
