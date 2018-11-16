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

class Twig_Node_Expression_AssignName extends Twig_Node_Expression_Name
{
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->raw('$context[')
            ->string($this->getAttribute('name'))
            ->raw(']')
        ;
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Node_Expression_AssignName', 'Twig\Node\Expression\AssignNameExpression', false);
>>>>>>> git-aline/master/master
