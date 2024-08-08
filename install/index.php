<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
Loader::IncludeModule('highloadblock');
use Bitrix\Highloadblock as HL;

Loc::loadMessages(__FILE__);


if (class_exists("spweb_linkslite")) return;

class spweb_linkslite extends CModule {
    
    var $MODULE_ID = "spweb.linkslite";
	var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $PARTNER_NAME;
    var $PARTNER_URI;
    var $MODULE_CSS;

    public function __construct(){
        $arModuleVersion = array();
        $path = str_replace( "\\", "/", __FILE__ );
        $path = substr( $path, 0, strlen( $path ) - strlen( "/index.php" ) );
        include( $path . "/version.php" );

        if ( is_array( $arModuleVersion ) && array_key_exists( "VERSION", $arModuleVersion ) ) {
            $this->MODULE_VERSION = $arModuleVersion[ "VERSION" ];
            $this->MODULE_VERSION_DATE = $arModuleVersion[ "VERSION_DATE" ];
        }

        $this->MODULE_NAME = Loc::GetMessage("linkslite_install_name");
        $this->MODULE_DESCRIPTION = Loc::GetMessage("linkslite_install_descr");
        $this->PARTNER_NAME = Loc::GetMessage("linkslite_install_partner");
        $this->PARTNER_URI = Loc::GetMessage("linkslite_install_url");
    }
    
    
    //INSTALL
    function DoInstall() {
        global $DOCUMENT_ROOT, $APPLICATION, $step;
		if ($step === '2')
		{
			global $GENERATE_INITIAL_DATA;
            $this->InstallBloks();
            $this->InstalDemoData(array('GENERATE_INITIAL_DATA' => $GENERATE_INITIAL_DATA));
            $this->InstallFiles();
            
			RegisterModule( "spweb.linkslite" );

			$APPLICATION->IncludeAdminFile(Loc::getMessage("linkslite_install_install"), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/spweb.linkslite/install/step2.php');
		}
		else // step 1
		{
			$APPLICATION->IncludeAdminFile(Loc::getMessage("linkslite_install_install"), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/spweb.linkslite/install/step1.php');
		}

    }

    
	function InstallBloks(){
		$this->InstallLinksHl();
        return true;
	}
    
    
    function InstalDemoData($params = array()){
        if ($params['GENERATE_INITIAL_DATA'] === 'Y'){
            
            $hlblock = HL\HighloadBlockTable::getList([
                        'filter' => ['=TABLE_NAME' => 'spectre_links_lite'],
                    ])->fetch();
            if ($hlblock){
                $ThisHlblock   = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock['ID'] )->fetch();
                $entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $ThisHlblock );
                $entity_data_class = $entity->getDataClass();
                $arData = array(
                            array(
                                'UF_URL' => '/catalog/',
                                'UF_NAME' => 'Пантолеты',
                                'UF_LINK' => '/catalog/pantolety/',
                                'UF_SORT' => '100',
                            ),
                            array(
                                'UF_URL' => '/catalog/',
                                'UF_NAME' => 'Футболка',
                                'UF_LINK' => '/catalog/t-shirts/women-s-t-shirt-night/',
                                'UF_SORT' => '500',
                            ),
                            array(
                                'UF_URL' => '/catalog/',
                                'UF_NAME' => 'Без рукавов',
                                'UF_LINK' => '/catalog/sportswear/sports-suit-evening-activities/',
                                'UF_SORT' => '200',
                            ),
                        );
                foreach($arData as $item){
                    $result = $entity_data_class::add($item);
                }
            }
        }
        return true;
    }
    
    
    function InstallLinksHl(){
        
        $if_hlblock = HL\HighloadBlockTable::getList([
            'filter' => ['=TABLE_NAME' => 'spectre_links_lite'],
        ])->fetch();
        
        if (!$if_hlblock){
            $arLangs = Array(
                'ru' => 'Быстрые ссылки',
                'en' => 'Quick links'
            );
            $result = HL\HighloadBlockTable::add(array(
                'NAME' => 'SpectreLinksLite',
                'TABLE_NAME' => 'spectre_links_lite', 
            ));
            if ($result->isSuccess()) {
                $id = $result->getId();

                foreach($arLangs as $lang_key => $lang_val){
                    HL\HighloadBlockLangTable::add(array(
                        'ID' => $id,
                        'LID' => $lang_key,
                        'NAME' => $lang_val
                    ));	
                }
            } else {
                $errors = $result->getErrorMessages();
                var_dump($errors);	
            }
            $UFObject = 'HLBLOCK_'.$id;

            $arCartFields = Array(
                'UF_URL'=>Array(
                    'ENTITY_ID' => $UFObject,
                    'FIELD_NAME' => 'UF_URL',
                    'USER_TYPE_ID' => 'string',
                    'MANDATORY' => 'Y',
                    "EDIT_FORM_LABEL" => Array('ru'=>'Адрес страницы', 'en'=>'Page address'), 
                    "LIST_COLUMN_LABEL" => Array('ru'=>'Адрес страницы', 'en'=>'Page address'),
                    "LIST_FILTER_LABEL" => Array('ru'=>'Адрес страницы', 'en'=>'Page address'), 
                    "ERROR_MESSAGE" => Array('ru'=>'Адрес страницы', 'en'=>'Page address'), 
                    "HELP_MESSAGE" => Array('ru'=>'Адрес страницы', 'en'=>'Page address'),
                ),
                'UF_NAME'=>Array(
                    'ENTITY_ID' => $UFObject,
                    'FIELD_NAME' => 'UF_NAME',
                    'USER_TYPE_ID' => 'string',
                    'MANDATORY' => 'Y',
                    "EDIT_FORM_LABEL" => Array('ru'=>'Текст ссылки', 'en'=>'Link text'), 
                    "LIST_COLUMN_LABEL" => Array('ru'=>'Текст ссылки', 'en'=>'Link text'),
                    "LIST_FILTER_LABEL" => Array('ru'=>'Текст ссылки', 'en'=>'Link text'), 
                    "ERROR_MESSAGE" => Array('ru'=>'Текст ссылки', 'en'=>'Link text'), 
                    "HELP_MESSAGE" => Array('ru'=>'Текст ссылки', 'en'=>'Link text'),
                ),
                'UF_LINK'=>Array(
                    'ENTITY_ID' => $UFObject,
                    'FIELD_NAME' => 'UF_LINK',
                    'USER_TYPE_ID' => 'string',
                    'MANDATORY' => 'Y',
                    "EDIT_FORM_LABEL" => Array('ru'=>'Ссылка', 'en'=>'Link'), 
                    "LIST_COLUMN_LABEL" => Array('ru'=>'Ссылка', 'en'=>'Link'),
                    "LIST_FILTER_LABEL" => Array('ru'=>'Ссылка', 'en'=>'Link'), 
                    "ERROR_MESSAGE" => Array('ru'=>'Ссылка', 'en'=>'Link'), 
                    "HELP_MESSAGE" => Array('ru'=>'Ссылка', 'en'=>'Link'),
                ),
                'UF_SORT'=>Array(
                    'ENTITY_ID' => $UFObject,
                    'FIELD_NAME' => 'UF_SORT',
                    'USER_TYPE_ID' => 'string',
                    'MANDATORY' => 'Y',
                    "EDIT_FORM_LABEL" => Array('ru'=>'Сортировка', 'en'=>'Sort'), 
                    "LIST_COLUMN_LABEL" => Array('ru'=>'Сортировка', 'en'=>'Sort'),
                    "LIST_FILTER_LABEL" => Array('ru'=>'Сортировка', 'en'=>'Sort'), 
                    "ERROR_MESSAGE" => Array('ru'=>'Сортировка', 'en'=>'Sort'), 
                    "HELP_MESSAGE" => Array('ru'=>'Сортировка', 'en'=>'Sort'),
                    'SETTINGS'=> array("DEFAULT_VALUE" => '100')
                ),
            );

            foreach($arCartFields as $arCartField){
                $obUserField  = new CUserTypeEntity;

                $ID = $obUserField->Add($arCartField);
            }
        }
        return true;
    }
    
    function InstallFiles() {
        CopyDirFiles( $_SERVER[ "DOCUMENT_ROOT" ] . "/bitrix/modules/spweb.linkslite/install/components",
            $_SERVER[ "DOCUMENT_ROOT" ] . "/bitrix/components", true, true );
        return true;
    }
    
    
	function UnInstallFiles($params = array())
	{

        if ($params['DEL_FILES'] !== 'Y'){
            $root = $_SERVER['DOCUMENT_ROOT'];
            DeleteDirFiles($root.'/bitrix/modules/spweb.linkslite/install/components' , $root.'/bitrix/components' );
            DeleteDirFilesEx($root.'/bitrix/components/spweb/linkslite');
        }

		return true;
	}
    
    
    function UnInstallDemoData($params = array()){
        if ($params['DEL_DEMO_DATA'] !== 'Y'){
            $hlblock = HL\HighloadBlockTable::getList([
                        'filter' => ['=TABLE_NAME' => 'spectre_links_lite'],
                    ])->fetch();
            if ($hlblock){
                HL\HighloadBlockTable::delete($hlblock['ID']); 
            }
        }
        return true;
    }
    
    
    //UNINSTALL
    function DoUninstall() {
        global $DOCUMENT_ROOT, $APPLICATION, $step;
        
		if ($step === '2')
		{
			global $DEL_DEMO_DATA;
            global $DEL_FILES;
            $this->UnInstallDemoData(array('DEL_DEMO_DATA' => $DEL_DEMO_DATA));
            $this->UnInstallFiles(array('DEL_FILES' => $DEL_FILES));
            UnRegisterModule( "spweb.linkslite" );
            
			$APPLICATION->IncludeAdminFile(GetMessage("linkslite_install_uninstall"), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/spweb.linkslite/install/unstep2.php');
		}
		else // step 1
		{
			$APPLICATION->IncludeAdminFile(GetMessage("linkslite_install_uninstall"), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/spweb.linkslite/install/unstep1.php');
		}
    }
    
}
?>