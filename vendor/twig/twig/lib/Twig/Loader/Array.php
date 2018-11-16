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
 * Loads a template from an array.
 *
 * When using this loader with a cache mechanism, you should know that a new cache
 * key is generated each time a template content "changes" (the cache key being the
 * source code of the template). If you don't want to see your cache grows out of
 * control, you need to take care of clearing the old cache file by yourself.
 *
 * This loader should only be used for unit testing.
 *
<<<<<<< HEAD
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Loader_Array implements Twig_LoaderInterface, Twig_ExistsLoaderInterface
=======
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Loader_Array implements Twig_LoaderInterface, Twig_ExistsLoaderInterface, Twig_SourceContextLoaderInterface
>>>>>>> git-aline/master/master
{
    protected $templates = array();

    /**
<<<<<<< HEAD
     * Constructor.
     *
     * @param array $templates An array of templates (keys are the names, and values are the source code)
     */
    public function __construct(array $templates)
=======
     * @param array $templates An array of templates (keys are the names, and values are the source code)
     */
    public function __construct(array $templates = array())
>>>>>>> git-aline/master/master
    {
        $this->templates = $templates;
    }

    /**
     * Adds or overrides a template.
     *
     * @param string $name     The template name
     * @param string $template The template source
     */
    public function setTemplate($name, $template)
    {
        $this->templates[(string) $name] = $template;
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
=======
    public function getSource($name)
    {
        @trigger_error(sprintf('Calling "getSource" on "%s" is deprecated since 1.27. Use getSourceContext() instead.', get_class($this)), E_USER_DEPRECATED);

>>>>>>> git-aline/master/master
        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

        return $this->templates[$name];
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
    public function getSourceContext($name)
    {
        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

        return new Twig_Source($this->templates[$name], $name);
    }

>>>>>>> git-aline/master/master
    public function exists($name)
    {
        return isset($this->templates[(string) $name]);
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
=======
>>>>>>> git-aline/master/master
    public function getCacheKey($name)
    {
        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

<<<<<<< HEAD
        return $this->templates[$name];
    }

    /**
     * {@inheritdoc}
     */
=======
        return $name.':'.$this->templates[$name];
    }

>>>>>>> git-aline/master/master
    public function isFresh($name, $time)
    {
        $name = (string) $name;
        if (!isset($this->templates[$name])) {
            throw new Twig_Error_Loader(sprintf('Template "%s" is not defined.', $name));
        }

        return true;
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Loader_Array', 'Twig\Loader\ArrayLoader', false);
>>>>>>> git-aline/master/master
