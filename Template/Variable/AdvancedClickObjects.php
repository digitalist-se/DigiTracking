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
        return "All Digitalist.se Tracking Helpers";
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
            $this->makeSetting('clickObjectFunction', 'clickParents', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Type of clickelement function to use';
                $field->description = 'clickParents will look upwards the DOM tree (parents) using closest() and clickChildren will look down below the clickElement using querySelector().';
                $field->inlineHelp = ' <a href="https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector">Learn about the querySelector function at the Mozilla docs</a><br>
                 <a href="https://developer.mozilla.org/en-US/docs/Web/API/Element/closest">Learn about the closest function at the Mozilla docs</a>';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'clickParents' => 'clickParents',
                    'clickChildren' => 'clickChildren',
                );
            }),
            $this->makeSetting('clickObjectSelector', '.the-parent', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'Enter the queryselector to use the find the element';
                $field->description = 'Enter a query selector to use to find the element relative to the click element (button below for example).';
                $field->inlineHelp = 'This could be a .className #id or [myMetaTag=value] etc<br>
                It can be anywhere above / below the click element<br>
                but it has to be a parent(clickParents) or child(clickChildren).<br>
                For example<br> <textarea style="border:none; resize: none; height: 80px" readonly>
                <div class="the-parent" meta-data="the-value">
                    <button>clickElement
                        <span class="the-child" child-meta="child-value"></span>
                    </button>
                </div> </textarea>';


                }),         
            $this->makeSetting('clickObjectSecondQuery', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Enable subquery for clickParents';
                $field->condition = 'clickObjectFunction == "clickParents"';
                $field->description = "This will give you the ability to do a querySelector on the parent to find siblings or other nested elements in the page.";
                $field->inlineHelp = 'clickElement.closest(".the-parent").querySelector(".sibling")<br>  
                For example<br> <textarea style="border:none; resize: none; height: 65px" readonly>
                <div class="the-parent">
                    <div class="sibling" sibling-meta="sibling-value"></div> 
                    <button>clickElement</button>
                </div> </textarea>';

            }),
            $this->makeSetting('clickObjectSecondQuerySelector', '.theSubElement', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'Enter query selector for additional logic';
                $field->condition = 'clickObjectSecondQuery == true';
                $field->description = 'Enter a query selector to use to find the sub element.';
                $field->inlineHelp = 'This could be a .className #id or [myMetaTag=value]';
                }),  
            $this->makeSetting('clickObjectLookupProperty', 'innerText', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Select the property you want to access';
                $field->description = 'The property you want to get data from after the querys have been done.';
                $field->inlineHelp = ' If you select custom you can enter it manually';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->validators[] = new NotEmpty();
                $field->availableValues = array(
                    'custom' => 'custom  - enter manually',
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
                );
            }),
            $this->makeSetting('clickObjectCustomProperty', 'meta-data', FieldConfig::TYPE_STRING, function (FieldConfig $field) {     
                $field->title = 'Tthe property you want to access. for example innerText or aria-label.';
                $field->condition = 'clickObjectLookupProperty == "custom"';
                $field->description = 'We will use the js function getAttribute("<meta-data>") to read the defined value from the element.';
                $field->inlineHelp = 'For example<br> <textarea style="border:none; resize: none; height: 52px" readonly>
                <div class="the-parent" meta-data="the-value">
                    <button>clickElement</button>
                </div> </textarea><br><br><a href="https://developer.mozilla.org/en-US/docs/Web/API/Element/getAttribute"> Learn about the getAttribute function at the Mozilla docs</a>';

            }),   

        );        
    }

}
