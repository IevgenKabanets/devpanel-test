<?php

/*
 * This file is part of Twig.
 *
<<<<<<< HEAD
 * (c) 2009 Fabien Potencier
 * (c) 2009 Armin Ronacher
=======
 * (c) Fabien Potencier
 * (c) Armin Ronacher
>>>>>>> git-aline/master/master
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Node_Expression_Conditional extends Twig_Node_Expression
{
    public function __construct(Twig_Node_Expression $expr1, Twig_Node_Expression $expr2, Twig_Node_Expression $expr3, $lineno)
    {
        parent::__construct(array('expr1' => $expr1, 'expr2' => $expr2, 'expr3' => $expr3), array(), $lineno);
    }

    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->raw('((')
            ->subcompile($this->getNode('expr1'))
            ->raw(') ? (')
            ->subcompile($this->getNode('expr2'))
            ->raw(') : (')
            ->subcompile($this->getNode('expr3'))
            ->raw('))')
        ;
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Node_Expression_Conditional', 'Twig\Node\Expression\ConditionalExpression', false);
>>>>>>> git-aline/master/master
