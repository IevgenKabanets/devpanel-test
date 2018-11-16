<?php

/*
 * This file is part of Twig.
 *
<<<<<<< HEAD
 * (c) 2009 Fabien Potencier
=======
 * (c) Fabien Potencier
>>>>>>> git-aline/master/master
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Filters a section of a template by applying filters.
 *
 * <pre>
 * {% filter upper %}
 *  This text becomes uppercase
 * {% endfilter %}
 * </pre>
<<<<<<< HEAD
=======
 *
 * @final
>>>>>>> git-aline/master/master
 */
class Twig_TokenParser_Filter extends Twig_TokenParser
{
    public function parse(Twig_Token $token)
    {
        $name = $this->parser->getVarName();
<<<<<<< HEAD
        $ref = new Twig_Node_Expression_BlockReference(new Twig_Node_Expression_Constant($name, $token->getLine()), true, $token->getLine(), $this->getTag());
=======
        $ref = new Twig_Node_Expression_BlockReference(new Twig_Node_Expression_Constant($name, $token->getLine()), null, $token->getLine(), $this->getTag());
>>>>>>> git-aline/master/master

        $filter = $this->parser->getExpressionParser()->parseFilterExpressionRaw($ref, $this->getTag());
        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        $block = new Twig_Node_Block($name, $body, $token->getLine());
        $this->parser->setBlock($name, $block);

        return new Twig_Node_Print($filter, $token->getLine(), $this->getTag());
    }

    public function decideBlockEnd(Twig_Token $token)
    {
        return $token->test('endfilter');
    }

    public function getTag()
    {
        return 'filter';
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_TokenParser_Filter', 'Twig\TokenParser\FilterTokenParser', false);
>>>>>>> git-aline/master/master
