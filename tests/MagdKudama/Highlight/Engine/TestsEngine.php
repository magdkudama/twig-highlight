<?php

namespace MagdKudama\Highlight\Engine;

use MagdKudama\Highlight\Engine;

class TestsEngine implements Engine
{
    /**
     * @param string $content
     * @param string $language
     * @param array $parameters
     * @throws \LogicException
     * @return string
     */
    public function getOutputFor($content, $language, array $parameters)
    {
        if ($language !== 'php') {
            throw new \LogicException;
        }

        return '';
    }
}
