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

class SearchReplaceTextsVariable extends BaseVariable
{
    public function getCategory()
    {
        //return self::CATEGORY_PAGE_VARIABLES;
        return "Aawesome Digitalist.se Tracking Helpers";

    }

    public function getName()
    {
        // By default, the name will be automatically fetched from the DigiTracking_SearchReplaceTextsVariableName translation key.
        // you can either adjust/create/remove this translation key, or return a different value here directly.
        return parent::getName();
    }

    public function getDescription()
    {
        // By default, the description will be automatically fetched from the DigiTracking_SearchReplaceTextsVariableDescription
        // translation key. you can either adjust/create/remove this translation key, or return a different value
        // here directly.
        return parent::getDescription();
    }

    public function getHelp()
    {
        // By default, the help will be automatically fetched from the DigiTracking_SearchReplaceTextsVariableHelp translation key.
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
        return parent::getIcon();
    }

    public function getParameters()
    {
        return array( 
            $this->makeSetting('inpuText', "", FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Custom URL';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->description = 'Optionally, specify a custom URL which should be tracked instead of the current location.';
            }),
            $this->makeSetting('replaceSocoalSecurityNumbers', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Anonymize Swedish social security numbers';
//               $field->description = "Anonymize";
                $field->inlineHelp = 'We will replace 1980-01-01-1234 with YYYY-MM-DD-XXXX <br>
                80-01-01-1234 with YY-MM-DD-XXXX<br>
                198001011234 with YYYYMMDDXXXX<br>
                8001011234 with YYMMDDXXXX<br>
                19800101-1234 with YYYYMMDD.XXXX<br>
                19 with YYYYMMDDXXXX';  
            }),
            $this->makeSetting('replaceCarPlates', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
                $field->title = 'Anonymize Swedish car registration plate numbers';
//                $field->description = "This will give you the ability to do a querySelector on the parent to find siblings or other nested elements in the page.";
                $field->inlineHelp = 'We will replace ABC123 with REGNROLD <br>
                ABC12A with REGNRNEW';  
            }),

        );
    }

}
