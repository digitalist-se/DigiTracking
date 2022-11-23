<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DigiTracking\Template\Variable;

use Piwik\Settings\FieldConfig;
use Piwik\Piwik;
use Piwik\Validators\NotEmpty;
use Piwik\Plugins\TagManager\Template\Variable\BaseVariable;

class AdvancedClickObjects extends BaseVariable
{
    public function getCategory()
    {
        //return self::CATEGORY_PAGE_VARIABLES;
        return "Aawesome Digitalist.se Tracking Helpers";
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
        return 'This variable will heplp you to get data from other html elements than the actual clickElement using relative querySelectors. So finally you can read that meta-data from a buttons parent element or a lot more advanced scenarios.';
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
            $this->makeSetting('clickObjectFunction', 'clickFixedLevels', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_ClickObjectFunctionTitle');
                $field->description = Piwik::translate('DigiTracking_ClickObjectFunctionDescription');
                $field->inlineHelp = Piwik::translate('DigiTracking_ClickObjectFunctionInlineHelp');
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'clickFixedLevels' => 'clickFixedLevels',
                    'clickParents' => 'clickParents',
                    'clickChildren' => 'clickChildren',
                );
            }),
            $this->makeSetting('customclickObjectDirection', 'up', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_CustomclickObjectDirectionTitle');
                $field->description = Piwik::translate('DigiTracking_CustomclickObjectDirectionDescription');                
                $field->condition = 'clickObjectFunction == "clickFixedLevels"';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'up' => 'up (parents)',
                    'down' => 'down (children)',
                );
            }),   
            $this->makeSetting('customclickObjectFixedLevels',1, FieldConfig::TYPE_INT, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_CustomclickObjectFixedLevelsTitle');
                $field->description = Piwik::translate('DigiTracking_CustomclickObjectFixedLevelsDescription');                
                $field->condition = 'clickObjectFunction == "clickFixedLevels"';
                $field->availableValues = array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                );
            }),   
            $this->makeSetting('clickObjectSelector', '.the-element', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_ClickObjectSelectorTitle');
                $field->description = Piwik::translate('DigiTracking_ClickObjectSelectorDescription');
                $field->inlineHelp = Piwik::translate('DigiTracking_ClickObjectSelectorInlineHelp');
                $field->condition = 'clickObjectFunction != "clickFixedLevels"';
                }),         
            $this->makeSetting('clickObjectSecondQuery', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_ClickObjectSecondQueryTitle');
                $field->description = Piwik::translate('DigiTracking_ClickObjectSecondQueryDescription');
                $field->condition = 'clickObjectFunction != "clickFixedLevels"';
            }),
            $this->makeSetting('clickObjectSecondQuerySelector', '.theSubElement', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_ClickObjectSecondQuerySelectorTitle');
                $field->description = Piwik::translate('DigiTracking_ClickObjectSecondQuerySelectorDescription');
                $field->inlineHelp = Piwik::translate('DigiTracking_ClickObjectSecondQuerySelectorInlineHelp');
                $field->condition = 'clickObjectSecondQuery == true';
                }),  
            $this->makeSetting('clickObjectLookupProperty', 'innerText', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = Piwik::translate('DigiTracking_ClickObjectLookupPropertyTitle');
                $field->description = Piwik::translate('DigiTracking_ClickObjectLookupPropertyDescription');
                $field->inlineHelp = Piwik::translate('DigiTracking_ClickObjectLookupPropertyInlineHelp');
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'custom' => 'custom  - enter manually',
                    'innerText' => 'innerText',
                    'innerHTML' => 'innerHTML',
                    'className' => 'className',
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
                );
            }),
            $this->makeSetting('clickObjectCustomProperty', '.meta-data', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = Piwik::translate('DigiTracking_clickObjectCustomPropertyTitle');
                $field->description = Piwik::translate('DigiTracking_clickObjectCustomPropertyDescription');
                $field->condition = 'clickObjectLookupProperty == "custom"';
                $field->inlineHelp = 'For example<br> <textarea style="border:none; resize: none; height: 52px" readonly>
                <div class="the-parent" meta-data="the-value">
                    <button>clickElement</button>
                </div> </textarea><br><br><a href="https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttribute"> Learn about the getAttribute function at the Mozilla docs</a>';

            }),   

        );        
    }

}
