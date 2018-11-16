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

@trigger_error('The Twig_Filter_Method class is deprecated since version 1.12 and will be removed in 2.0. Use Twig_SimpleFilter instead.', E_USER_DEPRECATED);

/**
 * Represents a method template filter.
 *
 * Use Twig_SimpleFilter instead.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class Twig_Filter_Method extends Twig_Filter
{
    protected $extension;
    protected $method;

    public function __construct(Twig_ExtensionInterface $extension, $method, array $options = array())
    {
        $options['callable'] = array($extension, $method);

        parent::__construct($options);

        $this->extension = $extension;
        $this->method = $method;
    }

    public function compile()
    {
<<<<<<< HEAD
        return sprintf('$this->env->getExtension(\'%s\')->%s', $this->extension->getName(), $this->method);
=======
        return sprintf('$this->env->getExtension(\'%s\')->%s', get_class($this->extension), $this->method);
>>>>>>> git-aline/master/master
    }
}
