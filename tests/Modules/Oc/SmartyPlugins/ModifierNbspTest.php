<?php

namespace OcTest\Modules\Oc\SmartyPlugins;

use OcTest\Modules\AbstractModuleTest;

require_once __DIR__ . '/../../../../htdocs/src/Oc/SmartyPlugins/modifier.nbsp.php';

class ModifierNbspTest extends AbstractModuleTest
{
    public function testNbsp()
    {
        self::assertEquals(
            '&nbsp;',
            \smarty_modifier_nbsp(' ')
        );
    }
}
