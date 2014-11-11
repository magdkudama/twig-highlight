<?php

namespace MagdKudama\Highlight;

interface Engine
{
    /**
     * @param string $content
     * @param string $language
     * @param array $parameters
     * @return string
     */
    public function getOutputFor($content, $language, array $parameters);
}
