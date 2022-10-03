<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DigiTracking\Template\Variable;

use Piwik\Settings\FieldConfig;
use Piwik\Validators\NotEmpty;
use Piwik\Plugins\TagManager\Template\Variable\BaseVariable;

class AdvancedClickObjects extends BaseVariable
{
    public function getCategory()
    {
        //return self::CATEGORY_PAGE_VARIABLES;
        return "Digitalist.se Tracking Helpers";
    }

    public function getName()
    {
        // By default, the name will be automatically fetched from the DigiTracking_ClickParentsVariableName translation key.
        // you can either adjust/create/remove this translation key, or return a different value here directly.
        return parent::getName();
    }

    public function getDescription()
    {
        // By default, the description will be automatically fetched from the DigiTracking_ClickParentsVariableDescription
        // translation key. you can either adjust/create/remove this translation key, or return a different value
        // here directly.
        //return parent::getDescription();
        return "Advanced Click Objects heplp you to fetch information from other html elements that the actual click object. <br> Test
        Somtimes you end up having to buld custom JS functions to do this and this is always a risk, since you need to handle all possible situations where the element you ask for does not exist etc<br>
        This variable has some built in validations and tries to make this work a little easier ";
    }

    public function getHelp()
    {
        // By default, the help will be automatically fetched from the DigiTracking_ClickParentsVariableHelp translation key.
        // you can either adjust/create/remove this translation key, or return a different value here directly.
        return parent::getHelp();
    }

    public function getIcon()
    {
        // You may optionally specify a path to an image icon URL, for example:
        //
        // return 'plugins/DigiTracking/images/MyIcon.png';
        //
        // The image should have ideally a resolution of about 64x64 pixels.
        return 'plugins/DigiTracking/images/icons/AdvancedClickObjects.svg';

        //return parent::getIcon();
    }

    public function getParameters()
    {
        return array(
            $this->makeSetting('clickObjectFunction', 'clickParents', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Type of clickelement function to use';
                $field->description = 'clickParents will look upwards the doom three (parents) usring closest() and clickChildren will look down below the clickElement using documentQuerySelector()';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'clickParents' => 'clickParents',
                    'clickChildren' => 'clickChildren',
                );
            }),
            $this->makeSetting('clickObjectSelector', '.theElement', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'Enter the queryselector to use the find the element';
                $field->description = 'This could be a .className or #id or [myMetaTag=value]';
            }),   
            $this->makeSetting('clickObjectLookupProperty', 'innerText', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Select the property you want to access';
                $field->description = 'Define the property you want to read data from with the js function getAttribute(). If you select custom you can enter it manually';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'innerText' => 'innerText',
                    'innerHTML' => 'innerHTML',
                    'class' => 'class',
                    'style' => 'style',
                    'id' => 'id',
                    'src' => 'src',
                    'hidden' => 'hidden',
                    'aria-expanded' => 'aria-expanded',
                    'aria-label' => 'aria-label',
                    'aria-checked' => 'aria-checked',
                    'aria-disabled' => 'aria-disabled',
                    'aria-hidden' => 'aria-hidden',
                    'aria-selected' => 'aria-selected',
                    'aria-required' => 'aria-required',
                    'custom' => 'custom  - enter manually',
                );
            }),
            $this->makeSetting('clickObjectCustomProperty', 'innerText', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'Manually enter the property you want to access. for example innerText or aria-label. ';
                $field->condition = 'clickObjectLookupProperty == "custom"';
                $field->description = 'We will use the js function getAttribute("<value>") to read the defined value from the element. https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttribute ';
            }),            
        );        
    }

}
