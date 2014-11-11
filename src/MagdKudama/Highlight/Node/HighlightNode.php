<?php

namespace MagdKudama\Highlight\Node;

class HighlightNode extends \Twig_Node
{
    public function __construct(
        \Twig_NodeInterface $body,
        $language,
        $variables = [],
        $ignoreErrors = false,
        $lineno,
        $tag = 'highlight'
    )
    {
        $nodes = ['body' => $body, 'language' => $language];

        if (!is_array($variables)) {
            $nodes['variables'] = $variables;
        }

        parent::__construct($nodes, ['ignoreErrors' => $ignoreErrors], $lineno, $tag);
    }

    /**
     * {@inheritdoc}
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        if ($this->getAttribute('ignoreErrors')) {
            $compiler
                ->write('try {' . PHP_EOL)
                ->indent();
        }

        $compiler
            ->write('ob_start();', PHP_EOL)
                ->subcompile($this->getNode('body'))
                ->write('$content = ob_get_clean();', PHP_EOL)
            ->write('$highlightEngine = $this->env->getTokenParsers()->getTokenParser(\'highlight\')->getEngine();', PHP_EOL)
            ->write('echo $highlightEngine->getOutputFor($content, ')
            ->subcompile($this->getNode('language'))
                ->write(', ');

        if ($this->hasNode('variables')) {
            $compiler->subcompile($this->getNode('variables'));
        } else {
            $compiler->write('[]');
        }

        $compiler
            ->write(');')
            ->write(PHP_EOL);

        if ($this->getAttribute('ignoreErrors')) {
            $compiler
                ->outdent()
                ->write('} catch (\Exception $e) {}' . PHP_EOL);
        }
    }
}
