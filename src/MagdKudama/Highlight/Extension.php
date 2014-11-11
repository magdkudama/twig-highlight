<?php

namespace MagdKudama\Highlight;

use MagdKudama\Highlight\TokenParser\HighlightTokenParser;

class Extension extends \Twig_Extension
{
    /**
     * @var Engine
     */
    private $engine;

    /**
     * @param Engine $engine
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return [
            new HighlightTokenParser($this->engine)
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'highlight';
    }
}
