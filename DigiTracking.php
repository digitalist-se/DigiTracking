<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DigiTracking;

class DigiTracking extends \Piwik\Plugin
{
 public function registerEvents()
    {
        $events = array(
            'Translate.getClientSideTranslationKeys' => 'getClientSideTranslationKeys',
        );
        return $events;
    }

   
    
}
