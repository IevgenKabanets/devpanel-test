<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

<<<<<<< HEAD
=======
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;

>>>>>>> git-aline/master/master
/**
 * Input is the base class for all concrete Input classes.
 *
 * Three concrete classes are provided by default:
 *
 *  * `ArgvInput`: The input comes from the CLI arguments (argv)
 *  * `StringInput`: The input is provided as a string
 *  * `ArrayInput`: The input is provided as an array
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
abstract class Input implements InputInterface
{
    /**
     * @var InputDefinition
     */
    protected $definition;
=======
abstract class Input implements InputInterface, StreamableInputInterface
{
    protected $definition;
    protected $stream;
>>>>>>> git-aline/master/master
    protected $options = array();
    protected $arguments = array();
    protected $interactive = true;

<<<<<<< HEAD
    /**
     * Constructor.
     *
     * @param InputDefinition $definition A InputDefinition instance
     */
=======
>>>>>>> git-aline/master/master
    public function __construct(InputDefinition $definition = null)
    {
        if (null === $definition) {
            $this->definition = new InputDefinition();
        } else {
            $this->bind($definition);
            $this->validate();
        }
    }

    /**
<<<<<<< HEAD
     * Binds the current Input instance with the given arguments and options.
     *
     * @param InputDefinition $definition A InputDefinition instance
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function bind(InputDefinition $definition)
    {
        $this->arguments = array();
        $this->options = array();
        $this->definition = $definition;

        $this->parse();
    }

    /**
     * Processes command line arguments.
     */
    abstract protected function parse();

    /**
<<<<<<< HEAD
     * Validates the input.
     *
     * @throws \RuntimeException When not enough arguments are given
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function validate()
    {
        $definition = $this->definition;
        $givenArguments = $this->arguments;

        $missingArguments = array_filter(array_keys($definition->getArguments()), function ($argument) use ($definition, $givenArguments) {
            return !array_key_exists($argument, $givenArguments) && $definition->getArgument($argument)->isRequired();
        });

<<<<<<< HEAD
        if (count($missingArguments) > 0) {
            throw new \RuntimeException(sprintf('Not enough arguments (missing: "%s").', implode(', ', $missingArguments)));
=======
        if (\count($missingArguments) > 0) {
            throw new RuntimeException(sprintf('Not enough arguments (missing: "%s").', implode(', ', $missingArguments)));
>>>>>>> git-aline/master/master
        }
    }

    /**
<<<<<<< HEAD
     * Checks if the input is interactive.
     *
     * @return bool Returns true if the input is interactive
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function isInteractive()
    {
        return $this->interactive;
    }

    /**
<<<<<<< HEAD
     * Sets the input interactivity.
     *
     * @param bool $interactive If the input should be interactive
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function setInteractive($interactive)
    {
        $this->interactive = (bool) $interactive;
    }

    /**
<<<<<<< HEAD
     * Returns the argument values.
     *
     * @return array An array of argument values
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function getArguments()
    {
        return array_merge($this->definition->getArgumentDefaults(), $this->arguments);
    }

    /**
<<<<<<< HEAD
     * Returns the argument value for a given argument name.
     *
     * @param string $name The argument name
     *
     * @return mixed The argument value
     *
     * @throws \InvalidArgumentException When argument given doesn't exist
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function getArgument($name)
    {
        if (!$this->definition->hasArgument($name)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException(sprintf('The "%s" argument does not exist.', $name));
=======
            throw new InvalidArgumentException(sprintf('The "%s" argument does not exist.', $name));
>>>>>>> git-aline/master/master
        }

        return isset($this->arguments[$name]) ? $this->arguments[$name] : $this->definition->getArgument($name)->getDefault();
    }

    /**
<<<<<<< HEAD
     * Sets an argument value by name.
     *
     * @param string $name  The argument name
     * @param string $value The argument value
     *
     * @throws \InvalidArgumentException When argument given doesn't exist
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function setArgument($name, $value)
    {
        if (!$this->definition->hasArgument($name)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException(sprintf('The "%s" argument does not exist.', $name));
=======
            throw new InvalidArgumentException(sprintf('The "%s" argument does not exist.', $name));
>>>>>>> git-aline/master/master
        }

        $this->arguments[$name] = $value;
    }

    /**
<<<<<<< HEAD
     * Returns true if an InputArgument object exists by name or position.
     *
     * @param string|int $name The InputArgument name or position
     *
     * @return bool true if the InputArgument object exists, false otherwise
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function hasArgument($name)
    {
        return $this->definition->hasArgument($name);
    }

    /**
<<<<<<< HEAD
     * Returns the options values.
     *
     * @return array An array of option values
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function getOptions()
    {
        return array_merge($this->definition->getOptionDefaults(), $this->options);
    }

    /**
<<<<<<< HEAD
     * Returns the option value for a given option name.
     *
     * @param string $name The option name
     *
     * @return mixed The option value
     *
     * @throws \InvalidArgumentException When option given doesn't exist
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function getOption($name)
    {
        if (!$this->definition->hasOption($name)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException(sprintf('The "%s" option does not exist.', $name));
        }

        return isset($this->options[$name]) ? $this->options[$name] : $this->definition->getOption($name)->getDefault();
    }

    /**
     * Sets an option value by name.
     *
     * @param string      $name  The option name
     * @param string|bool $value The option value
     *
     * @throws \InvalidArgumentException When option given doesn't exist
=======
            throw new InvalidArgumentException(sprintf('The "%s" option does not exist.', $name));
        }

        return array_key_exists($name, $this->options) ? $this->options[$name] : $this->definition->getOption($name)->getDefault();
    }

    /**
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function setOption($name, $value)
    {
        if (!$this->definition->hasOption($name)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException(sprintf('The "%s" option does not exist.', $name));
=======
            throw new InvalidArgumentException(sprintf('The "%s" option does not exist.', $name));
>>>>>>> git-aline/master/master
        }

        $this->options[$name] = $value;
    }

    /**
<<<<<<< HEAD
     * Returns true if an InputOption object exists by name.
     *
     * @param string $name The InputOption name
     *
     * @return bool true if the InputOption object exists, false otherwise
=======
     * {@inheritdoc}
>>>>>>> git-aline/master/master
     */
    public function hasOption($name)
    {
        return $this->definition->hasOption($name);
    }

    /**
     * Escapes a token through escapeshellarg if it contains unsafe chars.
     *
     * @param string $token
     *
     * @return string
     */
    public function escapeToken($token)
    {
        return preg_match('{^[\w-]+$}', $token) ? $token : escapeshellarg($token);
    }
<<<<<<< HEAD
=======

    /**
     * {@inheritdoc}
     */
    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function getStream()
    {
        return $this->stream;
    }
>>>>>>> git-aline/master/master
}
