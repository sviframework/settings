<?php

namespace Svi\SettingsBundle;

use Svi\SettingsBundle\Manager\SettingManager;
use Svi\SettingsBundle\Service\SettingsService;

trait BundleTrait
{

    /**
     * @return SettingManager
     */
    protected function getSettingManager()
    {
        return $this->app[SettingManager::class];
    }

    /**
     * @return SettingsService
     */
    protected function getSettingsService()
    {
        return $this->app[SettingsService::class];
    }

}