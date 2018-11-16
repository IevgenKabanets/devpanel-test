<?php

/*
 * This file is part of Twig.
 *
<<<<<<< HEAD
 * (c) 2015 Fabien Potencier
=======
 * (c) Fabien Potencier
>>>>>>> git-aline/master/master
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a profile leave node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Profiler_Node_LeaveProfile extends Twig_Node
{
    public function __construct($varName)
    {
        parent::__construct(array(), array('var_name' => $varName));
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> git-aline/master/master
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->write("\n")
            ->write(sprintf("\$%s->leave(\$%s);\n\n", $this->getAttribute('var_name'), $this->getAttribute('var_name').'_prof'))
        ;
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Profiler_Node_LeaveProfile', 'Twig\Profiler\Node\LeaveProfileNode', false);
>>>>>>> git-aline/master/master
