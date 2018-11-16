<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection;

<<<<<<< HEAD
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
=======
use Symfony\Component\DependencyInjection\Exception\EnvNotFoundException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ParameterCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
>>>>>>> git-aline/master/master

/**
 * Container is a dependency injection container.
 *
 * It gives access to object instances (services).
<<<<<<< HEAD
 *
 * Services and parameters are simple key/pair stores.
 *
 * Parameter and service keys are case insensitive.
 *
 * A service id can contain lowercased letters, digits, underscores, and dots.
 * Underscores are used to separate words, and dots to group services
 * under namespaces:
 *
 * <ul>
 *   <li>request</li>
 *   <li>mysql_session_storage</li>
 *   <li>symfony.mysql_session_storage</li>
 * </ul>
 *
 * A service can also be defined by creating a method named
 * getXXXService(), where XXX is the camelized version of the id:
 *
 * <ul>
 *   <li>request -> getRequestService()</li>
 *   <li>mysql_session_storage -> getMysqlSessionStorageService()</li>
 *   <li>symfony.mysql_session_storage -> getSymfony_MysqlSessionStorageService()</li>
 * </ul>
 *
 * The container can have three possible behaviors when a service does not exist:
=======
 * Services and parameters are simple key/pair stores.
 * The container can have four possible behaviors when a service
 * does not exist (or is not initialized for the last case):
>>>>>>> git-aline/master/master
 *
 *  * EXCEPTION_ON_INVALID_REFERENCE: Throws an exception (the default)
 *  * NULL_ON_INVALID_REFERENCE:      Returns null
 *  * IGNORE_ON_INVALID_REFERENCE:    Ignores the wrapping command asking for the reference
 *                                    (for instance, ignore a setter if the service does not exist)
<<<<<<< HEAD
=======
 *  * IGNORE_ON_UNINITIALIZED_REFERENCE: Ignores/returns null for uninitialized services or invalid references
>>>>>>> git-aline/master/master
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
<<<<<<< HEAD
class Container implements IntrospectableContainerInterface
{
    /**
     * @var ParameterBagInterface
     */
    protected $parameterBag;

    protected $services = array();
    protected $methodMap = array();
    protected $aliases = array();
    protected $scopes = array();
    protected $scopeChildren = array();
    protected $scopedServices = array();
    protected $scopeStacks = array();
    protected $loading = array();

    private $underscoreMap = array('_' => '', '.' => '_', '\\' => '_');

    /**
     * Constructor.
     *
     * @param ParameterBagInterface $parameterBag A ParameterBagInterface instance
     */
    public function __construct(ParameterBagInterface $parameterBag = null)
    {
        $this->parameterBag = $parameterBag ?: new ParameterBag();
=======
class Container implements ResettableContainerInterface
{
    protected $parameterBag;
    protected $services = array();
    protected $fileMap = array();
    protected $methodMap = array();
    protected $aliases = array();
    protected $loading = array();
    protected $resolving = array();
    protected $syntheticIds = array();

    /**
     * @internal
     */
    protected $privates = array();

    /**
     * @internal
     */
    protected $normalizedIds = array();

    private $underscoreMap = array('_' => '', '.' => '_', '\\' => '_');
    private $envCache = array();
    private $compiled = false;
    private $getEnv;

    public function __construct(ParameterBagInterface $parameterBag = null)
    {
        $this->parameterBag = $parameterBag ?: new EnvPlaceholderParameterBag();
>>>>>>> git-aline/master/master
    }

    /**
     * Compiles the container.
     *
     * This method does two things:
     *
     *  * Parameter values are resolved;
     *  * The parameter bag is frozen.
     */
    public function compile()
    {
        $this->parameterBag->resolve();

        $this->parameterBag = new FrozenParameterBag($this->parameterBag->all());
<<<<<<< HEAD
=======

        $this->compiled = true;
    }

    /**
     * Returns true if the container is compiled.
     *
     * @return bool
     */
    public function isCompiled()
    {
        return $this->compiled;
>>>>>>> git-aline/master/master
    }

    /**
     * Returns true if the container parameter bag are frozen.
     *
<<<<<<< HEAD
=======
     * @deprecated since version 3.3, to be removed in 4.0.
     *
>>>>>>> git-aline/master/master
     * @return bool true if the container parameter bag are frozen, false otherwise
     */
    public function isFrozen()
    {
<<<<<<< HEAD
=======
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

>>>>>>> git-aline/master/master
        return $this->parameterBag instanceof FrozenParameterBag;
    }

    /**
     * Gets the service container parameter bag.
     *
     * @return ParameterBagInterface A ParameterBagInterface instance
     */
    public function getParameterBag()
    {
        return $this->parameterBag;
    }

    /**
     * Gets a parameter.
     *
     * @param string $name The parameter name
     *
     * @return mixed The parameter value
     *
     * @throws InvalidArgumentException if the parameter is not defined
     */
    public function getParameter($name)
    {
        return $this->parameterBag->get($name);
    }

    /**
     * Checks if a parameter exists.
     *
     * @param string $name The parameter name
     *
     * @return bool The presence of parameter in container
     */
    public function hasParameter($name)
    {
        return $this->parameterBag->has($name);
    }

    /**
     * Sets a parameter.
     *
     * @param string $name  The parameter name
     * @param mixed  $value The parameter value
     */
    public function setParameter($name, $value)
    {
        $this->parameterBag->set($name, $value);
    }

    /**
     * Sets a service.
     *
     * Setting a service to null resets the service: has() returns false and get()
     * behaves in the same way as if the service was never created.
     *
     * @param string $id      The service identifier
     * @param object $service The service instance
<<<<<<< HEAD
     * @param string $scope   The scope of the service
     *
     * @throws RuntimeException         When trying to set a service in an inactive scope
     * @throws InvalidArgumentException When trying to set a service in the prototype scope
     */
    public function set($id, $service, $scope = self::SCOPE_CONTAINER)
    {
        if (self::SCOPE_PROTOTYPE === $scope) {
            throw new InvalidArgumentException(sprintf('You cannot set service "%s" of scope "prototype".', $id));
        }

        $id = strtolower($id);

        if ('service_container' === $id) {
            // BC: 'service_container' is no longer a self-reference but always
            // $this, so ignore this call.
            // @todo Throw InvalidArgumentException in next major release.
            return;
        }
        if (self::SCOPE_CONTAINER !== $scope) {
            if (!isset($this->scopedServices[$scope])) {
                throw new RuntimeException(sprintf('You cannot set service "%s" of inactive scope.', $id));
            }

            $this->scopedServices[$scope][$id] = $service;
        }

        $this->services[$id] = $service;

        if (method_exists($this, $method = 'synchronize'.strtr($id, $this->underscoreMap).'Service')) {
            $this->$method();
        }

        if (null === $service) {
            if (self::SCOPE_CONTAINER !== $scope) {
                unset($this->scopedServices[$scope][$id]);
            }

            unset($this->services[$id]);
        }
=======
     */
    public function set($id, $service)
    {
        // Runs the internal initializer; used by the dumped container to include always-needed files
        if (isset($this->privates['service_container']) && $this->privates['service_container'] instanceof \Closure) {
            $initialize = $this->privates['service_container'];
            unset($this->privates['service_container']);
            $initialize();
        }

        $id = $this->normalizeId($id);

        if ('service_container' === $id) {
            throw new InvalidArgumentException('You cannot set service "service_container".');
        }

        if (isset($this->privates[$id]) || !(isset($this->fileMap[$id]) || isset($this->methodMap[$id]))) {
            if (!isset($this->privates[$id]) && !isset($this->getRemovedIds()[$id])) {
                // no-op
            } elseif (null === $service) {
                @trigger_error(sprintf('The "%s" service is private, unsetting it is deprecated since Symfony 3.2 and will fail in 4.0.', $id), E_USER_DEPRECATED);
                unset($this->privates[$id]);
            } else {
                @trigger_error(sprintf('The "%s" service is private, replacing it is deprecated since Symfony 3.2 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            }
        } elseif (isset($this->services[$id])) {
            if (null === $service) {
                @trigger_error(sprintf('The "%s" service is already initialized, unsetting it is deprecated since Symfony 3.3 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            } else {
                @trigger_error(sprintf('The "%s" service is already initialized, replacing it is deprecated since Symfony 3.3 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            }
        }

        if (isset($this->aliases[$id])) {
            unset($this->aliases[$id]);
        }

        if (null === $service) {
            unset($this->services[$id]);

            return;
        }

        $this->services[$id] = $service;
>>>>>>> git-aline/master/master
    }

    /**
     * Returns true if the given service is defined.
     *
     * @param string $id The service identifier
     *
     * @return bool true if the service is defined, false otherwise
     */
    public function has($id)
    {
        for ($i = 2;;) {
<<<<<<< HEAD
            if ('service_container' === $id
                || isset($this->aliases[$id])
                || isset($this->services[$id])
                || array_key_exists($id, $this->services)
            ) {
                return true;
            }
            if (--$i && $id !== $lcId = strtolower($id)) {
                $id = $lcId;
            } else {
                return method_exists($this, 'get'.strtr($id, $this->underscoreMap).'Service');
            }
=======
            if (isset($this->privates[$id])) {
                @trigger_error(sprintf('The "%s" service is private, checking for its existence is deprecated since Symfony 3.2 and will fail in 4.0.', $id), E_USER_DEPRECATED);
            }
            if (isset($this->aliases[$id])) {
                $id = $this->aliases[$id];
            }
            if (isset($this->services[$id])) {
                return true;
            }
            if ('service_container' === $id) {
                return true;
            }

            if (isset($this->fileMap[$id]) || isset($this->methodMap[$id])) {
                return true;
            }

            if (--$i && $id !== $normalizedId = $this->normalizeId($id)) {
                $id = $normalizedId;
                continue;
            }

            // We only check the convention-based factory in a compiled container (i.e. a child class other than a ContainerBuilder,
            // and only when the dumper has not generated the method map (otherwise the method map is considered to be fully populated by the dumper)
            if (!$this->methodMap && !$this instanceof ContainerBuilder && __CLASS__ !== static::class && method_exists($this, 'get'.strtr($id, $this->underscoreMap).'Service')) {
                @trigger_error('Generating a dumped container without populating the method map is deprecated since Symfony 3.2 and will be unsupported in 4.0. Update your dumper to generate the method map.', E_USER_DEPRECATED);

                return true;
            }

            return false;
>>>>>>> git-aline/master/master
        }
    }

    /**
     * Gets a service.
     *
     * If a service is defined both through a set() method and
     * with a get{$id}Service() method, the former has always precedence.
     *
     * @param string $id              The service identifier
     * @param int    $invalidBehavior The behavior when the service does not exist
     *
     * @return object The associated service
     *
     * @throws ServiceCircularReferenceException When a circular reference is detected
     * @throws ServiceNotFoundException          When the service is not defined
     * @throws \Exception                        if an exception has been thrown when the service has been resolved
     *
     * @see Reference
     */
<<<<<<< HEAD
    public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
=======
    public function get($id, $invalidBehavior = /* self::EXCEPTION_ON_INVALID_REFERENCE */ 1)
>>>>>>> git-aline/master/master
    {
        // Attempt to retrieve the service by checking first aliases then
        // available services. Service IDs are case insensitive, however since
        // this method can be called thousands of times during a request, avoid
<<<<<<< HEAD
        // calling strtolower() unless necessary.
        for ($i = 2;;) {
            if ('service_container' === $id) {
                return $this;
=======
        // calling $this->normalizeId($id) unless necessary.
        for ($i = 2;;) {
            if (isset($this->privates[$id])) {
                @trigger_error(sprintf('The "%s" service is private, getting it from the container is deprecated since Symfony 3.2 and will fail in 4.0. You should either make the service public, or stop using the container directly and use dependency injection instead.', $id), E_USER_DEPRECATED);
>>>>>>> git-aline/master/master
            }
            if (isset($this->aliases[$id])) {
                $id = $this->aliases[$id];
            }
<<<<<<< HEAD
            // Re-use shared service instance if it exists.
            if (isset($this->services[$id]) || array_key_exists($id, $this->services)) {
                return $this->services[$id];
            }

            if (isset($this->loading[$id])) {
                throw new ServiceCircularReferenceException($id, array_keys($this->loading));
            }

            if (isset($this->methodMap[$id])) {
                $method = $this->methodMap[$id];
            } elseif (--$i && $id !== $lcId = strtolower($id)) {
                $id = $lcId;
                continue;
            } elseif (method_exists($this, $method = 'get'.strtr($id, $this->underscoreMap).'Service')) {
                // $method is set to the right value, proceed
            } else {
                if (self::EXCEPTION_ON_INVALID_REFERENCE === $invalidBehavior) {
                    if (!$id) {
                        throw new ServiceNotFoundException($id);
                    }

                    $alternatives = array();
                    foreach ($this->services as $key => $associatedService) {
                        $lev = levenshtein($id, $key);
                        if ($lev <= strlen($id) / 3 || false !== strpos($key, $id)) {
                            $alternatives[] = $key;
                        }
                    }

                    throw new ServiceNotFoundException($id, null, null, $alternatives);
                }

                return;
=======

            // Re-use shared service instance if it exists.
            if (isset($this->services[$id])) {
                return $this->services[$id];
            }
            if ('service_container' === $id) {
                return $this;
            }

            if (isset($this->loading[$id])) {
                throw new ServiceCircularReferenceException($id, array_merge(array_keys($this->loading), array($id)));
>>>>>>> git-aline/master/master
            }

            $this->loading[$id] = true;

            try {
<<<<<<< HEAD
                $service = $this->$method();
            } catch (\Exception $e) {
                unset($this->loading[$id]);

                if (array_key_exists($id, $this->services)) {
                    unset($this->services[$id]);
                }

                if ($e instanceof InactiveScopeException && self::EXCEPTION_ON_INVALID_REFERENCE !== $invalidBehavior) {
                    return;
                }

                throw $e;
            }

            unset($this->loading[$id]);

            return $service;
=======
                if (isset($this->fileMap[$id])) {
                    return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $this->load($this->fileMap[$id]);
                } elseif (isset($this->methodMap[$id])) {
                    return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $this->{$this->methodMap[$id]}();
                } elseif (--$i && $id !== $normalizedId = $this->normalizeId($id)) {
                    unset($this->loading[$id]);
                    $id = $normalizedId;
                    continue;
                } elseif (!$this->methodMap && !$this instanceof ContainerBuilder && __CLASS__ !== static::class && method_exists($this, $method = 'get'.strtr($id, $this->underscoreMap).'Service')) {
                    // We only check the convention-based factory in a compiled container (i.e. a child class other than a ContainerBuilder,
                    // and only when the dumper has not generated the method map (otherwise the method map is considered to be fully populated by the dumper)
                    @trigger_error('Generating a dumped container without populating the method map is deprecated since Symfony 3.2 and will be unsupported in 4.0. Update your dumper to generate the method map.', E_USER_DEPRECATED);

                    return /* self::IGNORE_ON_UNINITIALIZED_REFERENCE */ 4 === $invalidBehavior ? null : $this->{$method}();
                }

                break;
            } catch (\Exception $e) {
                unset($this->services[$id]);

                throw $e;
            } finally {
                unset($this->loading[$id]);
            }
        }

        if (/* self::EXCEPTION_ON_INVALID_REFERENCE */ 1 === $invalidBehavior) {
            if (!$id) {
                throw new ServiceNotFoundException($id);
            }
            if (isset($this->syntheticIds[$id])) {
                throw new ServiceNotFoundException($id, null, null, array(), sprintf('The "%s" service is synthetic, it needs to be set at boot time before it can be used.', $id));
            }
            if (isset($this->getRemovedIds()[$id])) {
                throw new ServiceNotFoundException($id, null, null, array(), sprintf('The "%s" service or alias has been removed or inlined when the container was compiled. You should either make it public, or stop using the container directly and use dependency injection instead.', $id));
            }

            $alternatives = array();
            foreach ($this->getServiceIds() as $knownId) {
                $lev = levenshtein($id, $knownId);
                if ($lev <= \strlen($id) / 3 || false !== strpos($knownId, $id)) {
                    $alternatives[] = $knownId;
                }
            }

            throw new ServiceNotFoundException($id, null, null, $alternatives);
>>>>>>> git-aline/master/master
        }
    }

    /**
     * Returns true if the given service has actually been initialized.
     *
     * @param string $id The service identifier
     *
     * @return bool true if service has already been initialized, false otherwise
     */
    public function initialized($id)
    {
<<<<<<< HEAD
        $id = strtolower($id);

        if ('service_container' === $id) {
            // BC: 'service_container' was a synthetic service previously.
            // @todo Change to false in next major release.
            return true;
=======
        $id = $this->normalizeId($id);

        if (isset($this->privates[$id])) {
            @trigger_error(sprintf('Checking for the initialization of the "%s" private service is deprecated since Symfony 3.4 and won\'t be supported anymore in Symfony 4.0.', $id), E_USER_DEPRECATED);
>>>>>>> git-aline/master/master
        }

        if (isset($this->aliases[$id])) {
            $id = $this->aliases[$id];
        }

<<<<<<< HEAD
        return isset($this->services[$id]) || array_key_exists($id, $this->services);
=======
        if ('service_container' === $id) {
            return false;
        }

        return isset($this->services[$id]);
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->services = array();
>>>>>>> git-aline/master/master
    }

    /**
     * Gets all service ids.
     *
     * @return array An array of all defined service ids
     */
    public function getServiceIds()
    {
        $ids = array();
<<<<<<< HEAD
        $r = new \ReflectionClass($this);
        foreach ($r->getMethods() as $method) {
            if (preg_match('/^get(.+)Service$/', $method->name, $match)) {
                $ids[] = self::underscore($match[1]);
=======

        if (!$this->methodMap && !$this instanceof ContainerBuilder && __CLASS__ !== static::class) {
            // We only check the convention-based factory in a compiled container (i.e. a child class other than a ContainerBuilder,
            // and only when the dumper has not generated the method map (otherwise the method map is considered to be fully populated by the dumper)
            @trigger_error('Generating a dumped container without populating the method map is deprecated since Symfony 3.2 and will be unsupported in 4.0. Update your dumper to generate the method map.', E_USER_DEPRECATED);

            foreach (get_class_methods($this) as $method) {
                if (preg_match('/^get(.+)Service$/', $method, $match)) {
                    $ids[] = self::underscore($match[1]);
                }
>>>>>>> git-aline/master/master
            }
        }
        $ids[] = 'service_container';

<<<<<<< HEAD
        return array_unique(array_merge($ids, array_keys($this->services)));
    }

    /**
     * This is called when you enter a scope.
     *
     * @param string $name
     *
     * @throws RuntimeException         When the parent scope is inactive
     * @throws InvalidArgumentException When the scope does not exist
     */
    public function enterScope($name)
    {
        if (!isset($this->scopes[$name])) {
            throw new InvalidArgumentException(sprintf('The scope "%s" does not exist.', $name));
        }

        if (self::SCOPE_CONTAINER !== $this->scopes[$name] && !isset($this->scopedServices[$this->scopes[$name]])) {
            throw new RuntimeException(sprintf('The parent scope "%s" must be active when entering this scope.', $this->scopes[$name]));
        }

        // check if a scope of this name is already active, if so we need to
        // remove all services of this scope, and those of any of its child
        // scopes from the global services map
        if (isset($this->scopedServices[$name])) {
            $services = array($this->services, $name => $this->scopedServices[$name]);
            unset($this->scopedServices[$name]);

            foreach ($this->scopeChildren[$name] as $child) {
                if (isset($this->scopedServices[$child])) {
                    $services[$child] = $this->scopedServices[$child];
                    unset($this->scopedServices[$child]);
                }
            }

            // update global map
            $this->services = call_user_func_array('array_diff_key', $services);
            array_shift($services);

            // add stack entry for this scope so we can restore the removed services later
            if (!isset($this->scopeStacks[$name])) {
                $this->scopeStacks[$name] = new \SplStack();
            }
            $this->scopeStacks[$name]->push($services);
        }

        $this->scopedServices[$name] = array();
    }

    /**
     * This is called to leave the current scope, and move back to the parent
     * scope.
     *
     * @param string $name The name of the scope to leave
     *
     * @throws InvalidArgumentException if the scope is not active
     */
    public function leaveScope($name)
    {
        if (!isset($this->scopedServices[$name])) {
            throw new InvalidArgumentException(sprintf('The scope "%s" is not active.', $name));
        }

        // remove all services of this scope, or any of its child scopes from
        // the global service map
        $services = array($this->services, $this->scopedServices[$name]);
        unset($this->scopedServices[$name]);

        foreach ($this->scopeChildren[$name] as $child) {
            if (isset($this->scopedServices[$child])) {
                $services[] = $this->scopedServices[$child];
                unset($this->scopedServices[$child]);
            }
        }

        // update global map
        $this->services = call_user_func_array('array_diff_key', $services);

        // check if we need to restore services of a previous scope of this type
        if (isset($this->scopeStacks[$name]) && count($this->scopeStacks[$name]) > 0) {
            $services = $this->scopeStacks[$name]->pop();
            $this->scopedServices += $services;

            if ($this->scopeStacks[$name]->isEmpty()) {
                unset($this->scopeStacks[$name]);
            }

            foreach ($services as $array) {
                foreach ($array as $id => $service) {
                    $this->set($id, $service, $name);
                }
            }
        }
    }

    /**
     * Adds a scope to the container.
     *
     * @param ScopeInterface $scope
     *
     * @throws InvalidArgumentException
     */
    public function addScope(ScopeInterface $scope)
    {
        $name = $scope->getName();
        $parentScope = $scope->getParentName();

        if (self::SCOPE_CONTAINER === $name || self::SCOPE_PROTOTYPE === $name) {
            throw new InvalidArgumentException(sprintf('The scope "%s" is reserved.', $name));
        }
        if (isset($this->scopes[$name])) {
            throw new InvalidArgumentException(sprintf('A scope with name "%s" already exists.', $name));
        }
        if (self::SCOPE_CONTAINER !== $parentScope && !isset($this->scopes[$parentScope])) {
            throw new InvalidArgumentException(sprintf('The parent scope "%s" does not exist, or is invalid.', $parentScope));
        }

        $this->scopes[$name] = $parentScope;
        $this->scopeChildren[$name] = array();

        // normalize the child relations
        while ($parentScope !== self::SCOPE_CONTAINER) {
            $this->scopeChildren[$parentScope][] = $name;
            $parentScope = $this->scopes[$parentScope];
        }
    }

    /**
     * Returns whether this container has a certain scope.
     *
     * @param string $name The name of the scope
     *
     * @return bool
     */
    public function hasScope($name)
    {
        return isset($this->scopes[$name]);
    }

    /**
     * Returns whether this scope is currently active.
     *
     * This does not actually check if the passed scope actually exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function isScopeActive($name)
    {
        return isset($this->scopedServices[$name]);
    }

    /**
     * Camelizes a string.
     *
     * @param string $id A string to camelize
     *
     * @return string The camelized string
     */
    public static function camelize($id)
    {
        return strtr(ucwords(strtr($id, array('_' => ' ', '.' => '_ ', '\\' => '_ '))), array(' ' => ''));
    }

    /**
     * A string to underscore.
     *
     * @param string $id The string to underscore
     *
     * @return string The underscored string
     */
    public static function underscore($id)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), strtr($id, '_', '.')));
=======
        return array_unique(array_merge($ids, array_keys($this->methodMap), array_keys($this->fileMap), array_keys($this->services)));
    }

    /**
     * Gets service ids that existed at compile time.
     *
     * @return array
     */
    public function getRemovedIds()
    {
        return array();
    }

    /**
     * Camelizes a string.
     *
     * @param string $id A string to camelize
     *
     * @return string The camelized string
     */
    public static function camelize($id)
    {
        return strtr(ucwords(strtr($id, array('_' => ' ', '.' => '_ ', '\\' => '_ '))), array(' ' => ''));
    }

    /**
     * A string to underscore.
     *
     * @param string $id The string to underscore
     *
     * @return string The underscored string
     */
    public static function underscore($id)
    {
        return strtolower(preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), str_replace('_', '.', $id)));
    }

    /**
     * Creates a service by requiring its factory file.
     *
     * @return object The service created by the file
     */
    protected function load($file)
    {
        return require $file;
    }

    /**
     * Fetches a variable from the environment.
     *
     * @param string $name The name of the environment variable
     *
     * @return mixed The value to use for the provided environment variable name
     *
     * @throws EnvNotFoundException When the environment variable is not found and has no default value
     */
    protected function getEnv($name)
    {
        if (isset($this->resolving[$envName = "env($name)"])) {
            throw new ParameterCircularReferenceException(array_keys($this->resolving));
        }
        if (isset($this->envCache[$name]) || array_key_exists($name, $this->envCache)) {
            return $this->envCache[$name];
        }
        if (!$this->has($id = 'container.env_var_processors_locator')) {
            $this->set($id, new ServiceLocator(array()));
        }
        if (!$this->getEnv) {
            $this->getEnv = new \ReflectionMethod($this, __FUNCTION__);
            $this->getEnv->setAccessible(true);
            $this->getEnv = $this->getEnv->getClosure($this);
        }
        $processors = $this->get($id);

        if (false !== $i = strpos($name, ':')) {
            $prefix = substr($name, 0, $i);
            $localName = substr($name, 1 + $i);
        } else {
            $prefix = 'string';
            $localName = $name;
        }
        $processor = $processors->has($prefix) ? $processors->get($prefix) : new EnvVarProcessor($this);

        $this->resolving[$envName] = true;
        try {
            return $this->envCache[$name] = $processor->getEnv($prefix, $localName, $this->getEnv);
        } finally {
            unset($this->resolving[$envName]);
        }
    }

    /**
     * Returns the case sensitive id used at registration time.
     *
     * @param string $id
     *
     * @return string
     *
     * @internal
     */
    public function normalizeId($id)
    {
        if (!\is_string($id)) {
            $id = (string) $id;
        }
        if (isset($this->normalizedIds[$normalizedId = strtolower($id)])) {
            $normalizedId = $this->normalizedIds[$normalizedId];
            if ($id !== $normalizedId) {
                @trigger_error(sprintf('Service identifiers will be made case sensitive in Symfony 4.0. Using "%s" instead of "%s" is deprecated since Symfony 3.3.', $id, $normalizedId), E_USER_DEPRECATED);
            }
        } else {
            $normalizedId = $this->normalizedIds[$normalizedId] = $id;
        }

        return $normalizedId;
    }

    private function __clone()
    {
>>>>>>> git-aline/master/master
    }
}
