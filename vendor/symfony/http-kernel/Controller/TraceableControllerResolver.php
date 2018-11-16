<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Controller;

<<<<<<< HEAD
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\HttpFoundation\Request;

/**
 * TraceableControllerResolver.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableControllerResolver implements ControllerResolverInterface
{
    private $resolver;
    private $stopwatch;

    /**
     * Constructor.
     *
     * @param ControllerResolverInterface $resolver  A ControllerResolverInterface instance
     * @param Stopwatch                   $stopwatch A Stopwatch instance
     */
    public function __construct(ControllerResolverInterface $resolver, Stopwatch $stopwatch)
    {
        $this->resolver = $resolver;
        $this->stopwatch = $stopwatch;
=======
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableControllerResolver implements ControllerResolverInterface, ArgumentResolverInterface
{
    private $resolver;
    private $stopwatch;
    private $argumentResolver;

    public function __construct(ControllerResolverInterface $resolver, Stopwatch $stopwatch, ArgumentResolverInterface $argumentResolver = null)
    {
        $this->resolver = $resolver;
        $this->stopwatch = $stopwatch;
        $this->argumentResolver = $argumentResolver;

        // BC
        if (null === $this->argumentResolver) {
            $this->argumentResolver = $resolver;
        }

        if (!$this->argumentResolver instanceof TraceableArgumentResolver) {
            $this->argumentResolver = new TraceableArgumentResolver($this->argumentResolver, $this->stopwatch);
        }
>>>>>>> git-aline/master/master
    }

    /**
     * {@inheritdoc}
     */
    public function getController(Request $request)
    {
        $e = $this->stopwatch->start('controller.get_callable');

        $ret = $this->resolver->getController($request);

        $e->stop();

        return $ret;
    }

    /**
     * {@inheritdoc}
<<<<<<< HEAD
     */
    public function getArguments(Request $request, $controller)
    {
        $e = $this->stopwatch->start('controller.get_arguments');

        $ret = $this->resolver->getArguments($request, $controller);

        $e->stop();
=======
     *
     * @deprecated This method is deprecated as of 3.1 and will be removed in 4.0.
     */
    public function getArguments(Request $request, $controller)
    {
        @trigger_error(sprintf('The "%s()" method is deprecated as of 3.1 and will be removed in 4.0. Please use the %s instead.', __METHOD__, TraceableArgumentResolver::class), E_USER_DEPRECATED);

        $ret = $this->argumentResolver->getArguments($request, $controller);
>>>>>>> git-aline/master/master

        return $ret;
    }
}
