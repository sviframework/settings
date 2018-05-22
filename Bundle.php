<?php

namespace Svi\SettingsBundle;

use Svi\SettingsBundle\Manager\SettingManager;
use Svi\SettingsBundle\Service\SettingsService;

class Bundle extends \Svi\Service\BundlesService\Bundle
{

    public function getServices()
    {
        return [
            SettingManager::class,
            SettingsService::class,
        ];
    }

}