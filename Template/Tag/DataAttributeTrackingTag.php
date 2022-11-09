<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DigiTracking\Template\Tag;

use Piwik\Settings\FieldConfig;
use Piwik\Piwik;
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
        return 'Add code that will enable you to do event tracking on your site just by adding data attributes to you html elements. Like: <textarea style="border:none;" readonly><button data-event-category="Click" data-event-action="Button" data-event-name="Data attribute test" data-event-value="10" >Data attribute test</button></textarea>';
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
        return array(
            $this->makeSetting('useDataLayer', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_UseDataLayerTitle');
                $field->description = Piwik::translate('DigiTracking_UseDataLayerDescription');
            }),
            $this->makeSetting('customEvent', 'customEvent', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_UseDataLayerCustomEvenTitle');
                $field->condition = 'useDataLayer == "true"';
                $field->description = Piwik::translate('DigiTracking_UseDataLayerCustomEvenDescription');    

            }),    
            $this->makeSetting('customEventCategory', 'eventCategory', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_UseDataLayerCustomEventCategoryTitle');
                $field->condition = 'useDataLayer == "1"';
                $field->description = Piwik::translate('DigiTracking_UseDataLayerCustomEventCategoryDescription');
            }), 

            $this->makeSetting('customEvenAction', 'evenAction', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_UseDataLayerCustomEventActionTitle');
                $field->condition = 'useDataLayer == "1"';
                $field->description = Piwik::translate('DigiTracking_UseDataLayerCustomEventActionDescription');
            }),         
            $this->makeSetting('customEventName', 'eventName', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_UseDataLayerCustomEventNameTitle');
                $field->condition = 'useDataLayer == "1"';
                $field->description = Piwik::translate('DigiTracking_UseDataLayerCustomEventNameDescription');
            }), 
            $this->makeSetting('customEventValue', 'eventValue', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_UseDataLayerCustomEventValueTitle');
                $field->condition = 'useDataLayer == "1"';
                $field->description = Piwik::translate('DigiTracking_UseDataLayerCustomEventValueDescription');
            }),         
        );
    }

}
