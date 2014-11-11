<?php

namespace MagdKudama\Highlight\Engine;

use KzykHys\Pygments\Pygments;
use MagdKudama\Highlight\Engine;

class PygmentsRenderer implements Engine
{
    /**
     * @param string $content
     * @param string $language
     * @param array $parameters
     * @return string
     */
    public function getOutputFor($content, $language, array $parameters = [])
    {
        $parser = new Pygments();

        $styles = '';
        if (isset($parameters['theme'])) {
            $styles .= '<style>' . $parser->getCss($parameters['theme']) . '</style>';
        }

        return $styles . $parser->highlight($content, $language, 'html');
    }
}
