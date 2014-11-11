<?php

namespace MagdKudama\Highlight\Engine;

use MagdKudama\Highlight\Engine;

class PygmentsRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PygmentsRenderer
     */
    private $instance;

    public function setUp()
    {
        $this->instance = new PygmentsRenderer();
    }

    public function testWithoutStyles()
    {
        $result = $this->instance->getOutputFor('test content', 'php', []);
        $this->assertNotContains('<style>', $result);
    }

    public function testWithStyles()
    {
        $result = $this->instance->getOutputFor('test content', 'php', ['theme' => 'vim']);
        $this->assertContains('<style>', $result);
    }
}
