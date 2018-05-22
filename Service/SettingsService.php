<?php

namespace Svi\SettingsBundle\Service;

use Svi\SettingsBundle\BundleTrait;
use Svi\SettingsBundle\Entity\Setting;
use Svi\AppContainer;

class SettingsService extends AppContainer
{
    use BundleTrait;

    private $allSettings;

    public function getSettingName($key)
    {
        $settings = $this->app->getConfigService()->get('settings');

        return is_string($settings[$key]) ? $settings[$key] : $settings[$key]['title'];
    }

    public function getSettingType($key)
    {
        $settings = $this->app->getConfigService()->get('settings');
        $type = is_array($settings[$key]) && isset($settings[$key]['type']) ? $settings[$key]['type'] : 'textarea';

        return $type;
    }

    public function updateDatabase()
    {
        /** @var Setting[] $exists */
        $exists = $this->getSettingManager()->findBy();

        foreach (array_keys($this->app->getConfigService()->get('settings')) as $key) {
            $inDb = null;
            foreach ($exists as $e) {
                if (strtolower($e->getKey()) == strtolower($key)) {
                    $inDb = $e;
                    break;
                }
            }
            if (!$inDb) {
                $inDb = new Setting();
                $inDb->setKey($key);
                $this->getSettingManager()->save($inDb);
            }
        }
    }

    public function get($key, $default = null)
    {
        $key = strtolower($key);
        $this->fetchAllSettings();

        return isset($this->allSettings[$key]) ? $this->allSettings[strtolower($key)] : $default;
    }

    public function set($key, $value)
    {
        $setting = $this->getSettingEntity($key);
        if ($setting) {
            $setting->setValue($value);
        } else {
            $setting = new Setting();
            $setting->setKey($key);
            $setting->setValue($value);
        }
        $this->getSettingManager()->save($setting);
        $this->allSettings[strtolower($key)] = $value;
    }

    /**
     * @param $key
     * @return Setting|null
     */
    public function getSettingEntity($key)
    {
        return $this->getSettingManager()->findOneByKey(strtolower($key));
    }

    protected function fetchAllSettings()
    {
        if (!isset($this->allSettings)) {
            $this->allSettings = [];
            foreach ($this->getSettingManager()->getConnection()->createQueryBuilder()->select('*')->from('setting', '')->execute()->fetchAll() as $v) {
                $this->allSettings[strtolower($v['skey'])] = $v['value'];
            }
        }
    }

}