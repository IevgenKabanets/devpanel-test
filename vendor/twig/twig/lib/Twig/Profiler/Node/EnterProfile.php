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
 * Represents a profile enter node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Profiler_Node_EnterProfile extends Twig_Node
{
    public function __construct($extensionName, $type, $name, $varName)
    {
        parent::__construct(array(), array('extension_name' => $extensionName, 'name' => $name, 'type' => $type, 'var_name' => $varName));
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
            ->write(sprintf('$%s = $this->env->getExtension(', $this->getAttribute('var_name')))
            ->repr($this->getAttribute('extension_name'))
            ->raw(");\n")
            ->write(sprintf('$%s->enter($%s = new Twig_Profiler_Profile($this->getTemplateName(), ', $this->getAttribute('var_name'), $this->getAttribute('var_name').'_prof'))
            ->repr($this->getAttribute('type'))
            ->raw(', ')
            ->repr($this->getAttribute('name'))
            ->raw("));\n\n")
        ;
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Profiler_Node_EnterProfile', 'Twig\Profiler\Node\EnterProfileNode', false);
>>>>>>> git-aline/master/master
