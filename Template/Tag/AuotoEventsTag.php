<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DigiTracking\Template\Tag;

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
                $field->title = 'Enable automatic event tracking of outlink clicks';
                $field->description = "This will automatically send events to Matomo for all clicks on external links. The reason for enebling this is that the built in tracker will not store the page URL from where the outlink was clicked. Events are named like this: EventCat: outlink EventAction: <click text> - <click destination url>  EventName: <page path>";
            }),
            $this->makeSetting('customOutLinkEventCategory', 'outlinkClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The eventCategory name to use for outlink events';
                $field->condition = 'enableOutLinkEvents == "1"';
                $field->description = 'The event category name to use. Note: action and name are set automatically in this tag';
            }),   
            $this->makeSetting('customOutLinkEventValuey', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = 'The eventValue name to use for outlink events';
                $field->condition = 'enableOutLinkEvents == "1"';
                $field->description = 'The event vale to use.';
            }),               
            $this->makeSetting('customOutLinkInternalDomains', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'Add a comma separated list of domains that you do not want to treat as outlinks.';
                $field->condition = 'enableOutLinkEvents == "1"';
                $field->description = 'A comma separated list of domais including protocol that will not report as outlinks. Example: https://example.com, https://example2.com. We do not support https://*.examples.com, you will need to add all domains manually.';
            }),                             
            $this->makeSetting('enableDownloadEvents', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Enable automatic event tracking of downloads';
                $field->description = "This will automatically send events to Matomo for all clicks on files (downloads). The reason for enebling this is that the built in tracker will not store the page URL from where the outlink was clicked. Events are named like this: EventCat: downloadClick EventAction: <click text> - <click destination url>  EventName: <page path>";
            }),
            $this->makeSetting('customDownloadkEventCategory', 'downloadClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The eventCategory name to use for download events';
                $field->condition = 'enableDownloadEvents == "1"';
                $field->description = 'The event category name to use. Note: action and name are set automatically in this tag';
            }),    
            $this->makeSetting('customDownloadEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = 'The eventValue name to use for download events';
                $field->condition = 'enableDownloadEvents == "1"';
                $field->description = 'The event vale to use.';
            }),  
            $this->makeSetting('enableDownloadExtensions', $downloadFileExtensions, FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Download Extensions';
                $field->description = 'Comma separated list of file extensions which will be considered as a download.';
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
                $field->title = 'Enable automatic event tracking of clicks on phone numbers';
                $field->description = "This will automatically send events to Matomo for all clicks on phone numbers.  Events are named like this: EventCat: phoneClick EventAction: <click text>,  EventName: <page path>";
            }),
            $this->makeSetting('customPhoneEventCategory', 'phoneClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The eventCategory name to use for these events';
                $field->condition = 'enablePhoneClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'The event category name to use. Note: action and name are set automatically in this tag';
            }),              
            $this->makeSetting('customPhoneEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = 'The eventValue name to use for phone number click events';
                $field->condition = 'enablePhoneClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'The event vale to use.';
            }),  
            $this->makeSetting('enableMailClicks', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Enable automatic event tracking of clicks on mail adresses';
                $field->description = "This will automatically send events to Matomo for all clicks on mail links.  Events are named like this: EventCat: mailClick EventAction: <click text>,  EventName: <page path>";
            }),
            $this->makeSetting('customMailEventCategory', 'mailClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The eventCategory name to use for these events';
                $field->condition = 'enableMailClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'The event category name to use. Note: action and name are set automatically in this tag';
            }),
            $this->makeSetting('customMailEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = 'The eventValue name to use for mail click events';
                $field->condition = 'enableMailClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'The event vale to use.';
            }),   
            $this->makeSetting('enableAccordionClicks', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Enable automatic event tracking of clicks on accordions ';
                $field->description = "This will automatically send events to Matomo when someone open an accordions.  Events are named like this: EventCat: accordionClick EventAction: <click text>,  EventName: <page path>";
            }),
            $this->makeSetting('customAccordionClickSelector', '.accordion-element', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The querySelector to use or accordion clicks';
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'This is how we detect the clicks. This should be a querySelector like accordion-item__top__toggle__icon-plus';
            }),
            $this->makeSetting('customAccordionOpenSelector', '[aria-expanded]', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The querySelector to use to check if an accordion is already open';
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'Since we only want to send the event when the accordion is opened. By default we use aria-expanded on the click object (but if this does not exist) you can manually enter something else like a classs or you can use ';
            }),                            
            $this->makeSetting('customAccordionEventCategory', 'accordionClick', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The eventCategory name to use for these events';
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'The event category name to use. Note: action and name are set automatically in this tag';
            }),
            $this->makeSetting('customAccordionEventValue', 0, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = 'The eventValue name to use for accordion click events';
                $field->condition = 'enableAccordionClicks == "1"';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'The event vale to use.';
            }),               
        );
    }

}
