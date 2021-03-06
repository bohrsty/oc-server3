<?php

namespace OcTest\Modules\Oc\SmartyPlugins;

use OcTest\Modules\AbstractModuleTest;

require_once __DIR__ . '/../../../../htdocs/src/Oc/SmartyPlugins/function.repeat.php';

class RepeatTest extends AbstractModuleTest
{
    public function testRepeat()
    {
        $smarty = null;
        self::assertEquals(
            'stringstring',
            \smarty_function_repeat(['string' => 'string', 'count' => 2], $smarty)
        );
    }
}
