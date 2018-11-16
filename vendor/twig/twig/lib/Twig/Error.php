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
 * Twig base exception.
 *
 * This exception class and its children must only be used when
 * an error occurs during the loading of a template, when a syntax error
 * is detected in a template, or when rendering a template. Other
 * errors must use regular PHP exception classes (like when the template
 * cache directory is not writable for instance).
 *
 * To help debugging template issues, this class tracks the original template
 * name and line where the error occurred.
 *
 * Whenever possible, you must set these information (original template name
 * and line number) yourself by passing them to the constructor. If some or all
 * these information are not available from where you throw the exception, then
 * this class will guess them automatically (when the line number is set to -1
<<<<<<< HEAD
 * and/or the filename is set to null). As this is a costly operation, this
 * can be disabled by passing false for both the filename and the line number
=======
 * and/or the name is set to null). As this is a costly operation, this
 * can be disabled by passing false for both the name and the line number
>>>>>>> git-aline/master/master
 * when creating a new instance of this class.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Error extends Exception
{
    protected $lineno;
<<<<<<< HEAD
=======
    // to be renamed to name in 2.0
>>>>>>> git-aline/master/master
    protected $filename;
    protected $rawMessage;
    protected $previous;

<<<<<<< HEAD
    /**
     * Constructor.
     *
     * Set both the line number and the filename to false to
=======
    private $sourcePath;
    private $sourceCode;

    /**
     * Constructor.
     *
     * Set both the line number and the name to false to
>>>>>>> git-aline/master/master
     * disable automatic guessing of the original template name
     * and line number.
     *
     * Set the line number to -1 to enable its automatic guessing.
<<<<<<< HEAD
     * Set the filename to null to enable its automatic guessing.
     *
     * By default, automatic guessing is enabled.
     *
     * @param string    $message  The error message
     * @param int       $lineno   The template line where the error occurred
     * @param string    $filename The template file name where the error occurred
     * @param Exception $previous The previous exception
     */
    public function __construct($message, $lineno = -1, $filename = null, Exception $previous = null)
    {
=======
     * Set the name to null to enable its automatic guessing.
     *
     * By default, automatic guessing is enabled.
     *
     * @param string                  $message  The error message
     * @param int                     $lineno   The template line where the error occurred
     * @param Twig_Source|string|null $source   The source context where the error occurred
     * @param Exception               $previous The previous exception
     */
    public function __construct($message, $lineno = -1, $source = null, Exception $previous = null)
    {
        if (null === $source) {
            $name = null;
        } elseif (!$source instanceof Twig_Source) {
            // for compat with the Twig C ext., passing the template name as string is accepted
            $name = $source;
        } else {
            $name = $source->getName();
            $this->sourceCode = $source->getCode();
            $this->sourcePath = $source->getPath();
        }
>>>>>>> git-aline/master/master
        if (PHP_VERSION_ID < 50300) {
            $this->previous = $previous;
            parent::__construct('');
        } else {
            parent::__construct('', 0, $previous);
        }

        $this->lineno = $lineno;
<<<<<<< HEAD
        $this->filename = $filename;

        if (-1 === $this->lineno || null === $this->filename) {
=======
        $this->filename = $name;

        if (-1 === $lineno || null === $name || null === $this->sourcePath) {
>>>>>>> git-aline/master/master
            $this->guessTemplateInfo();
        }

        $this->rawMessage = $message;

        $this->updateRepr();
    }

    /**
     * Gets the raw message.
     *
     * @return string The raw message
     */
    public function getRawMessage()
    {
        return $this->rawMessage;
    }

    /**
<<<<<<< HEAD
     * Gets the filename where the error occurred.
     *
     * @return string The filename
     */
    public function getTemplateFile()
    {
=======
     * Gets the logical name where the error occurred.
     *
     * @return string The name
     *
     * @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead.
     */
    public function getTemplateFile()
    {
        @trigger_error(sprintf('The "%s" method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', __METHOD__), E_USER_DEPRECATED);

>>>>>>> git-aline/master/master
        return $this->filename;
    }

    /**
<<<<<<< HEAD
     * Sets the filename where the error occurred.
     *
     * @param string $filename The filename
     */
    public function setTemplateFile($filename)
    {
        $this->filename = $filename;
=======
     * Sets the logical name where the error occurred.
     *
     * @param string $name The name
     *
     * @deprecated since 1.27 (to be removed in 2.0). Use setSourceContext() instead.
     */
    public function setTemplateFile($name)
    {
        @trigger_error(sprintf('The "%s" method is deprecated since version 1.27 and will be removed in 2.0. Use setSourceContext() instead.', __METHOD__), E_USER_DEPRECATED);

        $this->filename = $name;

        $this->updateRepr();
    }

    /**
     * Gets the logical name where the error occurred.
     *
     * @return string The name
     *
     * @deprecated since 1.29 (to be removed in 2.0). Use getSourceContext() instead.
     */
    public function getTemplateName()
    {
        @trigger_error(sprintf('The "%s" method is deprecated since version 1.29 and will be removed in 2.0. Use getSourceContext() instead.', __METHOD__), E_USER_DEPRECATED);

        return $this->filename;
    }

    /**
     * Sets the logical name where the error occurred.
     *
     * @param string $name The name
     *
     * @deprecated since 1.29 (to be removed in 2.0). Use setSourceContext() instead.
     */
    public function setTemplateName($name)
    {
        @trigger_error(sprintf('The "%s" method is deprecated since version 1.29 and will be removed in 2.0. Use setSourceContext() instead.', __METHOD__), E_USER_DEPRECATED);

        $this->filename = $name;
        $this->sourceCode = $this->sourcePath = null;
>>>>>>> git-aline/master/master

        $this->updateRepr();
    }

    /**
     * Gets the template line where the error occurred.
     *
     * @return int The template line
     */
    public function getTemplateLine()
    {
        return $this->lineno;
    }

    /**
     * Sets the template line where the error occurred.
     *
     * @param int $lineno The template line
     */
    public function setTemplateLine($lineno)
    {
        $this->lineno = $lineno;

        $this->updateRepr();
    }

<<<<<<< HEAD
=======
    /**
     * Gets the source context of the Twig template where the error occurred.
     *
     * @return Twig_Source|null
     */
    public function getSourceContext()
    {
        return $this->filename ? new Twig_Source($this->sourceCode, $this->filename, $this->sourcePath) : null;
    }

    /**
     * Sets the source context of the Twig template where the error occurred.
     */
    public function setSourceContext(Twig_Source $source = null)
    {
        if (null === $source) {
            $this->sourceCode = $this->filename = $this->sourcePath = null;
        } else {
            $this->sourceCode = $source->getCode();
            $this->filename = $source->getName();
            $this->sourcePath = $source->getPath();
        }

        $this->updateRepr();
    }

>>>>>>> git-aline/master/master
    public function guess()
    {
        $this->guessTemplateInfo();
        $this->updateRepr();
    }

    /**
     * For PHP < 5.3.0, provides access to the getPrevious() method.
     *
     * @param string $method    The method name
     * @param array  $arguments The parameters to be passed to the method
     *
     * @return Exception The previous exception or null
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $arguments)
    {
        if ('getprevious' == strtolower($method)) {
            return $this->previous;
        }

        throw new BadMethodCallException(sprintf('Method "Twig_Error::%s()" does not exist.', $method));
    }

    public function appendMessage($rawMessage)
    {
        $this->rawMessage .= $rawMessage;
        $this->updateRepr();
    }

    /**
     * @internal
     */
    protected function updateRepr()
    {
        $this->message = $this->rawMessage;

<<<<<<< HEAD
=======
        if ($this->sourcePath && $this->lineno > 0) {
            $this->file = $this->sourcePath;
            $this->line = $this->lineno;

            return;
        }

>>>>>>> git-aline/master/master
        $dot = false;
        if ('.' === substr($this->message, -1)) {
            $this->message = substr($this->message, 0, -1);
            $dot = true;
        }

        $questionMark = false;
        if ('?' === substr($this->message, -1)) {
            $this->message = substr($this->message, 0, -1);
            $questionMark = true;
        }

        if ($this->filename) {
            if (is_string($this->filename) || (is_object($this->filename) && method_exists($this->filename, '__toString'))) {
<<<<<<< HEAD
                $filename = sprintf('"%s"', $this->filename);
            } else {
                $filename = json_encode($this->filename);
            }
            $this->message .= sprintf(' in %s', $filename);
=======
                $name = sprintf('"%s"', $this->filename);
            } else {
                $name = json_encode($this->filename);
            }
            $this->message .= sprintf(' in %s', $name);
>>>>>>> git-aline/master/master
        }

        if ($this->lineno && $this->lineno >= 0) {
            $this->message .= sprintf(' at line %d', $this->lineno);
        }

        if ($dot) {
            $this->message .= '.';
        }

        if ($questionMark) {
            $this->message .= '?';
        }
    }

    /**
     * @internal
     */
    protected function guessTemplateInfo()
    {
        $template = null;
        $templateClass = null;

        if (PHP_VERSION_ID >= 50306) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS | DEBUG_BACKTRACE_PROVIDE_OBJECT);
        } else {
            $backtrace = debug_backtrace();
        }

        foreach ($backtrace as $trace) {
            if (isset($trace['object']) && $trace['object'] instanceof Twig_Template && 'Twig_Template' !== get_class($trace['object'])) {
                $currentClass = get_class($trace['object']);
                $isEmbedContainer = 0 === strpos($templateClass, $currentClass);
                if (null === $this->filename || ($this->filename == $trace['object']->getTemplateName() && !$isEmbedContainer)) {
                    $template = $trace['object'];
                    $templateClass = get_class($trace['object']);
                }
            }
        }

<<<<<<< HEAD
        // update template filename
=======
        // update template name
>>>>>>> git-aline/master/master
        if (null !== $template && null === $this->filename) {
            $this->filename = $template->getTemplateName();
        }

<<<<<<< HEAD
=======
        // update template path if any
        if (null !== $template && null === $this->sourcePath) {
            $src = $template->getSourceContext();
            $this->sourceCode = $src->getCode();
            $this->sourcePath = $src->getPath();
        }

>>>>>>> git-aline/master/master
        if (null === $template || $this->lineno > -1) {
            return;
        }

        $r = new ReflectionObject($template);
        $file = $r->getFileName();

<<<<<<< HEAD
        // hhvm has a bug where eval'ed files comes out as the current directory
        if (is_dir($file)) {
            $file = '';
        }

=======
>>>>>>> git-aline/master/master
        $exceptions = array($e = $this);
        while (($e instanceof self || method_exists($e, 'getPrevious')) && $e = $e->getPrevious()) {
            $exceptions[] = $e;
        }

        while ($e = array_pop($exceptions)) {
            $traces = $e->getTrace();
            array_unshift($traces, array('file' => $e->getFile(), 'line' => $e->getLine()));

            while ($trace = array_shift($traces)) {
                if (!isset($trace['file']) || !isset($trace['line']) || $file != $trace['file']) {
                    continue;
                }

                foreach ($template->getDebugInfo() as $codeLine => $templateLine) {
                    if ($codeLine <= $trace['line']) {
                        // update template line
                        $this->lineno = $templateLine;

                        return;
                    }
                }
            }
        }
    }
}
<<<<<<< HEAD
=======

class_alias('Twig_Error', 'Twig\Error\Error', false);
class_exists('Twig_Source');
>>>>>>> git-aline/master/master
