<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DigiTracking\Template\Tag;
use Piwik\Piwik;
use Piwik\Settings\FieldConfig;
use Piwik\Plugins\TagManager\Template\Tag\BaseTag;
use Piwik\Validators\NotEmpty;
use Piwik\Validators\CharacterLength;
class AuotoEventsTag extends BaseTag
{
    public function getName()
    {
        // By default, the name will be automatically fetched from the DigiTracking_CustomHtmlTagName translation key.
        // you can either adjust/create/remove this translation key, or return a different value here directly.
        return parent::getName();
    }

    public function getDescription()
    {
        // By default, the description will be automatically fetched from the DigiTracking_CustomHtmlTagDescription
        // translation key. you can either adjust/create/remove this translation key, or return a different value
        // here directly.
        //return self::CATEGORY_CUSTOM;
        return "This tag will give you several pre configured event tracking options for outlinks, downloads, mail clicks ans phone link clicks. Just enable the tracking you want and execute it on pageviews. If you want different logic on different pages you can set up several tags that will execute on different parts of the site.";
    }

    public function getHelp()
    {
        // By default, the help will be automatically fetched from the DigiTracking_CustomHtmlTagHelp translation key.
        // you can either adjust/create/remove this translation key, or return a different value here directly.
        return parent::getHelp();
    }

    public function getCategory()
    {
        //return self::CATEGORY_CUSTOM;
        return "Aawesome Digitalist.se Tracking Helpers";

    }

    public function getIcon()
    {
        // You may optionally specify a path to an image icon URL, for example:
        //
        // return 'plugins/DigiTracking/images/MyIcon.png';
        //
        // to not return default icon call:
        // return parent::getIcon();
        //
        // The image should have ideally a resolution of about 64x64 pixels.
        return 'plugins/DigiTracking/images/icons/AuotoEvents.svg';
    }

    public function getParameters()
    {
        $downloadFileExtensions = array('7z','aac','apk','arc','arj','asf','asx','avi','azw3','bin','csv','deb','dmg','doc','docx','epub','exe','flv','gif','gz','gzip','hqx','ibooks','jar','jpg','jpeg','js','mobi','mp2','mp3','mp4','mpg','mpeg','mov','movie','msi','msp','odb','odf','odg','ods','odt','ogg','ogv','pdf','phps','png','ppt','pptx','qt','qtm','ra','ram','rar','rpm','sea','sit','tar','tbz','tbz2','bz','bz2','tgz','torrent','txt','wav','wma','wmv','wpd','xls','xlsx','xml','z','zip');
        $downloadFileExtensions = implode(',', $downloadFileExtensions);
        return array(
            $this->makeSetting('enableOutLinkEvents', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_EnableOutLinkEventsTitle');
                $field->description = Piwik::translate('DigiTracking_EnableOutLinkEventsDescription');
            }),
            $this->makeSetting('customOutLinkEventCategory', 'outlinkClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_CustomOutLinkEventCategoryTitle');
                $field->description = Piwik::translate('DigiTracking_CustomOutLinkEventCategoryDescription');                
                $field->condition = 'enableOutLinkEvents == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),   
            $this->makeSetting('customOutLinkEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_CustomOutLinkEventValueTitle');
                $field->description = Piwik::translate('DigiTracking_CustomOutLinkEventValueDescription');                
                $field->condition = 'enableOutLinkEvents == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),               
            $this->makeSetting('customOutLinkInternalDomains', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_CustomOutLinkInternalDomainsTitle');
                $field->description = Piwik::translate('DigiTracking_CustomOutLinkInternalDomainsDescription');    
                $field->condition = 'enableOutLinkEvents == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),                             
            $this->makeSetting('enableDownloadEvents', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_EnableDownloadEventsTitle');
                $field->description = Piwik::translate('DigiTracking_EnableDownloadEventsDescription');
            }),
            $this->makeSetting('customDownloadkEventCategory', 'downloadClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_CustomDownloadkEventCategoryTitle');
                $field->description = Piwik::translate('DigiTracking_CustomDownloadkEventCategoryDescription');     
                $field->condition = 'enableDownloadEvents == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),    
            $this->makeSetting('customDownloadEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {    
                $field->title = Piwik::translate('DigiTracking_CustomDownloadkEventValueTitle');
                $field->description = Piwik::translate('DigiTracking_CustomDownloadkEventValueDescription');     
                $field->condition = 'enableDownloadEvents == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),  
            $this->makeSetting('enableDownloadExtensions', $downloadFileExtensions, FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_EnableDownloadExtensionsTitle');
                $field->description = Piwik::translate('DigiTracking_EnableDownloadExtensionseDescription');     
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->validators[] = new NotEmpty();
                $field->validators[] = new CharacterLength($min = 1, $max = 700);
                $field->condition = 'enableDownloadEvents == "1"';
                $field->transform = function ($value) {
                    $value = explode(',', $value);
                    foreach ($value as $i => $val) {
                            $value[$i] = trim($val);
                    }
                    return implode(',', $value);
                };
            }),          
            $this->makeSetting('enablePhoneClicks', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_EnablePhoneClicksTitle');
                $field->description = Piwik::translate('DigiTracking_EnablePhoneClicksDescription');     
            }),
            $this->makeSetting('customPhoneEventCategory', 'phoneClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {    
                $field->title = Piwik::translate('DigiTracking_CustomPhoneEventCategoryTitle');
                $field->description = Piwik::translate('DigiTracking_CustomPhoneEventCategoryDescription');   
                $field->condition = 'enablePhoneClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),              
            $this->makeSetting('customPhoneEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {    
                $field->title = Piwik::translate('DigiTracking_CustomPhoneEventValueTitle');
                $field->description = Piwik::translate('DigiTracking_CustomPhoneEventValueDescription');    
                $field->condition = 'enablePhoneClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),  
            $this->makeSetting('enableMailClicks', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_EnableMailClicksTitle');
                $field->description = Piwik::translate('DigiTracking_EnableMailClicksDescription');   
            }),
            $this->makeSetting('customMailEventCategory', 'mailClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_CustomMailEventCategoryTitle');
                $field->description = Piwik::translate('DigiTracking_CustomMailEventCategoryDescription');      
                $field->condition = 'enableMailClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),
            $this->makeSetting('customMailEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {   
                $field->title = Piwik::translate('DigiTracking_CustomMailEventValueTitle');
                $field->description = Piwik::translate('DigiTracking_CustomMailValueDescription');     
                $field->condition = 'enableMailClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),   
            /**              
            $this->makeSetting('enableAccordionClicks', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_EnableAccordionClicksTitle');
                $field->description = Piwik::translate('DigiTracking_EnableAccordionClicksDescription');   
                $field->title = 'Enable automatic event tracking of clicks on accordions ';
                $field->description = "This will automatically send events to Matomo when someone open an accordions.  Events are named like this: EventCat: accordionClick EventAction: <click text>,  EventName: <page path>";
            }),
            $this->makeSetting('customAccordionClickSelector', '.accordion-element', FieldConfig::TYPE_STRING, function (FieldConfig $field) {   
                $field->title = Piwik::translate('DigiTracking_CustomAccordionClickSelectorTitle');
                $field->description = Piwik::translate('DigiTracking_CustomAccordionClickSelectorTitleDescription');     
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),
            $this->makeSetting('customAccordionOpenSelector', '[aria-expanded]', FieldConfig::TYPE_STRING, function (FieldConfig $field) {    
                $field->title = Piwik::translate('DigiTracking_customAccordionOpenSelectorTitle');
                $field->description = Piwik::translate('DigiTracking_customAccordionOpenSelectorDescription');  
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),                            
            $this->makeSetting('customAccordionEventCategory', 'accordionClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_CustomAccordionEventCategoryTitle');
                $field->description = Piwik::translate('DigiTracking_CustomAccordionEventCategoryDescription');        
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),
            $this->makeSetting('customAccordionEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {  
                $field->title = Piwik::translate('DigiTracking_CustomAccordionEventValueTitle');
                $field->description = Piwik::translate('DigiTracking_CustomAccordionEventValueDescription');    
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
            }),      
            */
        );
    }

}
