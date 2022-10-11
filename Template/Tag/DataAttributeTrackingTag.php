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

class DataAttributeTrackingTag extends BaseTag
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
        //return parent::getDescription();
        return 'Add code that will enable you to do event tracking on your site just by adding data attributes to you html elements. Like: <textarea readonly><button data-event-category="Click" data-event-action="Button" data-event-name="Data attribute test" data-event-value="10" >Data attribute test</button></textarea>';
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
        return 'plugins/DigiTracking/images/icons/DataAttribute.svg';
    }

    public function getParameters()
    {
        $downloadFileExtensions = array('7z','aac','apk','arc','arj','asf','asx','avi','azw3','bin','csv','deb','dmg','doc','docx','epub','exe','flv','gif','gz','gzip','hqx','ibooks','jar','jpg','jpeg','js','mobi','mp2','mp3','mp4','mpg','mpeg','mov','movie','msi','msp','odb','odf','odg','ods','odt','ogg','ogv','pdf','phps','png','ppt','pptx','qt','qtm','ra','ram','rar','rpm','sea','sit','tar','tbz','tbz2','bz','bz2','tgz','torrent','txt','wav','wma','wmv','wpd','xls','xlsx','xml','z','zip');
        $downloadFileExtensions = implode(',', $downloadFileExtensions);
        return array(
            $this->makeSetting('useDataLayer', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Send data as a custom event to Datalayer';
                $field->description = "You can choose to send the events via the DataLayer with custom Events instead of directly pushing the events to Matomo with _paq.push(['trackEvent',....) The reason for doing so would give you more control in the TagManager. You can set up more rules etc. If you enable this you will need to manually set up 3 datalayer variables, a trigger and a Matomo Event before anything will be sent to Matomo";
            }),
            $this->makeSetting('customEvent', 'customEvent', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The name to use for the custom Event.';
                $field->condition = 'useDataLayer == "true"';
                $field->description = 'We will send event to the datalayer with the name you define here. For example mtm.push({  "event": "customEvent"}); ';
            }),    
            $this->makeSetting('customEventCategory', 'eventCategory', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The name of the datalayer variable name to use for eventCategory data';
                $field->condition = 'useDataLayer == "1"';
                $field->description = 'This is the name you will use for the datalayer variable you need to create. For example mtm.push({  "event": "customEvent", "eventCategory": "value", "eventAction": "value","eventName": "value","eventValue": "value"  }); ';
            }), 

            $this->makeSetting('customEvenAction', 'evenAction', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The name of the datalayer variable name to use for eventAction data';
                $field->condition = 'useDataLayer == "1"';
                $field->description = 'This is the name you will use for the datalayer variable you need to create. For example mtm.push({  "event": "customEvent", "eventCategory": "value", "eventAction": "value","eventName": "value","eventValue": "value"  }); ';
            }),         
            $this->makeSetting('customEventName', 'eventName', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The name of the datalayer variable name to use for eventAction data';
                $field->condition = 'useDataLayer == "1"';
                $field->description = 'This is the name you will use for the datalayer variable you need to create. For example mtm.push({  "event": "customEvent", "eventCategory": "value", "eventAction": "value","eventName": "value","eventValue": "value"  }); ';
            }), 
            $this->makeSetting('customEventValue', 'eventValue', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'The name of the datalayer variable name to use for eventAction data';
                $field->condition = 'useDataLayer == "1"';
                $field->description = 'This is the name you will use for the datalayer variable you need to create. For example mtm.push({  "event": "customEvent", "eventCategory": "value", "eventAction": "value","eventName": "value","eventValue": "value"  }); ';
            }),         
        );
    }

}
