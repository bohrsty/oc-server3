<?php

namespace OcTest\Modules\Oc\SmartyPlugins;

use OcTest\Modules\AbstractModuleTest;

require_once __DIR__ . '/../../../../htdocs/src/Oc/SmartyPlugins/modifier.format_hour.php';

class ModifierFormatHourTest extends AbstractModuleTest
{
    public function testFormatHour()
    {
        self::assertEquals(
            '1:30',
            \smarty_modifier_format_hour('1.5')
        );
    }
}
