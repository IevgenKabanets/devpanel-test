<?php

/*
 * This file is part of Twig.
 *
<<<<<<< HEAD
 * (c) 2010 Fabien Potencier
=======
 * (c) Fabien Potencier
>>>>>>> git-aline/master/master
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Node_Expression_Binary_NotEqual extends Twig_Node_Expression_Binary
{
    public function operator(Twig_Compiler $compiler)
    {
        return $compiler->raw('!=');
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Node_Expression_Binary_NotEqual', 'Twig\Node\Expression\Binary\NotEqualBinary', false);
>>>>>>> git-aline/master/master
