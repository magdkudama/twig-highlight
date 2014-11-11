<?php

namespace MagdKudama\Highlight;

use MagdKudama\Highlight\Engine\TestsEngine;

class ExtensionFunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $template
     * @param bool $shouldFail
     * @dataProvider templateProvider
     */
    public function testRunningWithTemplateEngines($template, $shouldFail)
    {
        if ($shouldFail) {
            $this->setExpectedException('Twig_Error_Runtime');
        }

        $this->getTemplateContent($template);
    }

    public function testUnknownAttributeThrowsException()
    {
        $this->setExpectedException('Twig_Error_Syntax');

        $this->getTemplateContent('unknown_tag_attributes');
    }

    public function templateProvider()
    {
        return [
            ['all_parameters', false],
            ['empty_parameters', false],
            ['error_language', true],
            ['error_language_ignoring_errors', false],
            ['no_parameters', false],
        ];
    }

    /**
     * @param $template
     * @param array $parameters
     * @return string
     */
    private function getTemplateContent($template, array $parameters = [])
    {
        $template = $this->createTwig()->loadTemplate($template . '.html.twig');

        return $template->render($parameters);
    }

    /**
     * @return \Twig_Environment
     */
    private function createTwig()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/fixtures');
        $twig = new \Twig_Environment($loader);

        $twig->addExtension(new Extension(new TestsEngine()));

        return $twig;
    }
}
