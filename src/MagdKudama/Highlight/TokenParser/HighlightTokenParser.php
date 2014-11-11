<?php

namespace MagdKudama\Highlight\TokenParser;

use MagdKudama\Highlight\Engine;
use MagdKudama\Highlight\Node\HighlightNode;

class HighlightTokenParser extends \Twig_TokenParser
{
    /**
     * @var Engine $engine
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
     * @return Engine
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $expressionParser = $this->parser->getExpressionParser();

        $language = $expressionParser->parseExpression();

        $variables = [];
        if ($stream->nextIf(\Twig_Token::NAME_TYPE, 'with')) {
            $variables = $expressionParser->parseExpression();
        }

        $ignoreErrors = false;
        if ($stream->nextIf(\Twig_Token::NAME_TYPE, 'ignore_errors')) {
            $ignoreErrors = true;
        }

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse([$this, 'decideEnd'], true);

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new HighlightNode($body, $language, $variables, $ignoreErrors, $token->getLine(), $this->getTag());
    }

    /**
     * Decide when to stop parsing the Creole block
     *
     * @param \Twig_Token $token
     * @return bool
     */
    public function decideEnd(\Twig_Token $token)
    {
        return $token->test('endhighlight');
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'highlight';
    }
}