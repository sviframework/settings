<?php

namespace Svi\SettingsBundle\Manager;

use Svi\SettingsBundle\Entity\Setting;
use Svi\OrmBundle\Manager;

class SettingManager extends Manager
{

    public function getDbFieldsDefinition()
    {
        return [
            'key'   => ['skey', 'string', 'length' => 32, 'primary'],
            'value' => ['value', 'text', 'null'],
        ];
    }

    public function getTableName()
    {
        return 'setting';
    }

    public function getEntityClassName()
    {
        return Setting::class;
    }

}