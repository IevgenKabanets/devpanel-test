<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector;

<<<<<<< HEAD
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * RequestDataCollector.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class RequestDataCollector extends DataCollector implements EventSubscriberInterface
=======
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class RequestDataCollector extends DataCollector implements EventSubscriberInterface, LateDataCollectorInterface
>>>>>>> git-aline/master/master
{
    protected $controllers;

    public function __construct()
    {
        $this->controllers = new \SplObjectStorage();
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
<<<<<<< HEAD
        $responseHeaders = $response->headers->all();
        $cookies = array();
        foreach ($response->headers->getCookies() as $cookie) {
            $cookies[] = $this->getCookieHeader($cookie->getName(), $cookie->getValue(), $cookie->getExpiresTime(), $cookie->getPath(), $cookie->getDomain(), $cookie->isSecure(), $cookie->isHttpOnly());
        }
        if (count($cookies) > 0) {
            $responseHeaders['Set-Cookie'] = $cookies;
        }

        // attributes are serialized and as they can be anything, they need to be converted to strings.
        $attributes = array();
        foreach ($request->attributes->all() as $key => $value) {
            if ('_route' === $key && is_object($value)) {
                $attributes[$key] = $this->varToString($value->getPath());
            } elseif ('_route_params' === $key) {
                // we need to keep route params as an array (see getRouteParams())
                foreach ($value as $k => $v) {
                    $value[$k] = $this->varToString($v);
                }
                $attributes[$key] = $value;
            } else {
                $attributes[$key] = $this->varToString($value);
=======
        // attributes are serialized and as they can be anything, they need to be converted to strings.
        $attributes = array();
        $route = '';
        foreach ($request->attributes->all() as $key => $value) {
            if ('_route' === $key) {
                $route = \is_object($value) ? $value->getPath() : $value;
                $attributes[$key] = $route;
            } else {
                $attributes[$key] = $value;
>>>>>>> git-aline/master/master
            }
        }

        $content = null;
        try {
            $content = $request->getContent();
        } catch (\LogicException $e) {
            // the user already got the request content as a resource
            $content = false;
        }

        $sessionMetadata = array();
        $sessionAttributes = array();
<<<<<<< HEAD
=======
        $session = null;
>>>>>>> git-aline/master/master
        $flashes = array();
        if ($request->hasSession()) {
            $session = $request->getSession();
            if ($session->isStarted()) {
                $sessionMetadata['Created'] = date(DATE_RFC822, $session->getMetadataBag()->getCreated());
                $sessionMetadata['Last used'] = date(DATE_RFC822, $session->getMetadataBag()->getLastUsed());
                $sessionMetadata['Lifetime'] = $session->getMetadataBag()->getLifetime();
                $sessionAttributes = $session->all();
                $flashes = $session->getFlashBag()->peekAll();
            }
        }

        $statusCode = $response->getStatusCode();

<<<<<<< HEAD
        $this->data = array(
=======
        $responseCookies = array();
        foreach ($response->headers->getCookies() as $cookie) {
            $responseCookies[$cookie->getName()] = $cookie;
        }

        $this->data = array(
            'method' => $request->getMethod(),
>>>>>>> git-aline/master/master
            'format' => $request->getRequestFormat(),
            'content' => $content,
            'content_type' => $response->headers->get('Content-Type', 'text/html'),
            'status_text' => isset(Response::$statusTexts[$statusCode]) ? Response::$statusTexts[$statusCode] : '',
            'status_code' => $statusCode,
            'request_query' => $request->query->all(),
            'request_request' => $request->request->all(),
            'request_headers' => $request->headers->all(),
            'request_server' => $request->server->all(),
            'request_cookies' => $request->cookies->all(),
            'request_attributes' => $attributes,
<<<<<<< HEAD
            'response_headers' => $responseHeaders,
=======
            'route' => $route,
            'response_headers' => $response->headers->all(),
            'response_cookies' => $responseCookies,
>>>>>>> git-aline/master/master
            'session_metadata' => $sessionMetadata,
            'session_attributes' => $sessionAttributes,
            'flashes' => $flashes,
            'path_info' => $request->getPathInfo(),
            'controller' => 'n/a',
            'locale' => $request->getLocale(),
        );

        if (isset($this->data['request_headers']['php-auth-pw'])) {
            $this->data['request_headers']['php-auth-pw'] = '******';
        }

        if (isset($this->data['request_server']['PHP_AUTH_PW'])) {
            $this->data['request_server']['PHP_AUTH_PW'] = '******';
        }

        if (isset($this->data['request_request']['_password'])) {
            $this->data['request_request']['_password'] = '******';
        }

<<<<<<< HEAD
        if (isset($this->controllers[$request])) {
            $controller = $this->controllers[$request];
            if (is_array($controller)) {
                try {
                    $r = new \ReflectionMethod($controller[0], $controller[1]);
                    $this->data['controller'] = array(
                        'class' => is_object($controller[0]) ? get_class($controller[0]) : $controller[0],
                        'method' => $controller[1],
                        'file' => $r->getFileName(),
                        'line' => $r->getStartLine(),
                    );
                } catch (\ReflectionException $e) {
                    if (is_callable($controller)) {
                        // using __call or  __callStatic
                        $this->data['controller'] = array(
                            'class' => is_object($controller[0]) ? get_class($controller[0]) : $controller[0],
                            'method' => $controller[1],
                            'file' => 'n/a',
                            'line' => 'n/a',
                        );
                    }
                }
            } elseif ($controller instanceof \Closure) {
                $r = new \ReflectionFunction($controller);
                $this->data['controller'] = array(
                    'class' => $r->getName(),
                    'method' => null,
                    'file' => $r->getFileName(),
                    'line' => $r->getStartLine(),
                );
            } elseif (is_object($controller)) {
                $r = new \ReflectionClass($controller);
                $this->data['controller'] = array(
                    'class' => $r->getName(),
                    'method' => null,
                    'file' => $r->getFileName(),
                    'line' => $r->getStartLine(),
                );
            } else {
                $this->data['controller'] = (string) $controller ?: 'n/a';
            }
            unset($this->controllers[$request]);
        }
=======
        foreach ($this->data as $key => $value) {
            if (!\is_array($value)) {
                continue;
            }
            if ('request_headers' === $key || 'response_headers' === $key) {
                $this->data[$key] = array_map(function ($v) { return isset($v[0]) && !isset($v[1]) ? $v[0] : $v; }, $value);
            }
        }

        if (isset($this->controllers[$request])) {
            $this->data['controller'] = $this->parseController($this->controllers[$request]);
            unset($this->controllers[$request]);
        }

        if ($request->attributes->has('_redirected') && $redirectCookie = $request->cookies->get('sf_redirect')) {
            $this->data['redirect'] = json_decode($redirectCookie, true);

            $response->headers->clearCookie('sf_redirect');
        }

        if ($response->isRedirect()) {
            $response->headers->setCookie(new Cookie(
                'sf_redirect',
                json_encode(array(
                    'token' => $response->headers->get('x-debug-token'),
                    'route' => $request->attributes->get('_route', 'n/a'),
                    'method' => $request->getMethod(),
                    'controller' => $this->parseController($request->attributes->get('_controller')),
                    'status_code' => $statusCode,
                    'status_text' => Response::$statusTexts[(int) $statusCode],
                ))
            ));
        }

        $this->data['identifier'] = $this->data['route'] ?: (\is_array($this->data['controller']) ? $this->data['controller']['class'].'::'.$this->data['controller']['method'].'()' : $this->data['controller']);
    }

    public function lateCollect()
    {
        $this->data = $this->cloneVar($this->data);
    }

    public function reset()
    {
        $this->data = array();
        $this->controllers = new \SplObjectStorage();
    }

    public function getMethod()
    {
        return $this->data['method'];
>>>>>>> git-aline/master/master
    }

    public function getPathInfo()
    {
        return $this->data['path_info'];
    }

    public function getRequestRequest()
    {
<<<<<<< HEAD
        return new ParameterBag($this->data['request_request']);
=======
        return new ParameterBag($this->data['request_request']->getValue());
>>>>>>> git-aline/master/master
    }

    public function getRequestQuery()
    {
<<<<<<< HEAD
        return new ParameterBag($this->data['request_query']);
=======
        return new ParameterBag($this->data['request_query']->getValue());
>>>>>>> git-aline/master/master
    }

    public function getRequestHeaders()
    {
<<<<<<< HEAD
        return new HeaderBag($this->data['request_headers']);
    }

    public function getRequestServer()
    {
        return new ParameterBag($this->data['request_server']);
    }

    public function getRequestCookies()
    {
        return new ParameterBag($this->data['request_cookies']);
=======
        return new ParameterBag($this->data['request_headers']->getValue());
    }

    public function getRequestServer($raw = false)
    {
        return new ParameterBag($this->data['request_server']->getValue($raw));
    }

    public function getRequestCookies($raw = false)
    {
        return new ParameterBag($this->data['request_cookies']->getValue($raw));
>>>>>>> git-aline/master/master
    }

    public function getRequestAttributes()
    {
<<<<<<< HEAD
        return new ParameterBag($this->data['request_attributes']);
=======
        return new ParameterBag($this->data['request_attributes']->getValue());
>>>>>>> git-aline/master/master
    }

    public function getResponseHeaders()
    {
<<<<<<< HEAD
        return new ResponseHeaderBag($this->data['response_headers']);
=======
        return new ParameterBag($this->data['response_headers']->getValue());
    }

    public function getResponseCookies()
    {
        return new ParameterBag($this->data['response_cookies']->getValue());
>>>>>>> git-aline/master/master
    }

    public function getSessionMetadata()
    {
<<<<<<< HEAD
        return $this->data['session_metadata'];
=======
        return $this->data['session_metadata']->getValue();
>>>>>>> git-aline/master/master
    }

    public function getSessionAttributes()
    {
<<<<<<< HEAD
        return $this->data['session_attributes'];
=======
        return $this->data['session_attributes']->getValue();
>>>>>>> git-aline/master/master
    }

    public function getFlashes()
    {
<<<<<<< HEAD
        return $this->data['flashes'];
=======
        return $this->data['flashes']->getValue();
>>>>>>> git-aline/master/master
    }

    public function getContent()
    {
        return $this->data['content'];
    }

    public function getContentType()
    {
        return $this->data['content_type'];
    }

    public function getStatusText()
    {
        return $this->data['status_text'];
    }

    public function getStatusCode()
    {
        return $this->data['status_code'];
    }

    public function getFormat()
    {
        return $this->data['format'];
    }

    public function getLocale()
    {
        return $this->data['locale'];
    }

    /**
     * Gets the route name.
     *
     * The _route request attributes is automatically set by the Router Matcher.
     *
     * @return string The route
     */
    public function getRoute()
    {
<<<<<<< HEAD
        return isset($this->data['request_attributes']['_route']) ? $this->data['request_attributes']['_route'] : '';
=======
        return $this->data['route'];
    }

    public function getIdentifier()
    {
        return $this->data['identifier'];
>>>>>>> git-aline/master/master
    }

    /**
     * Gets the route parameters.
     *
     * The _route_params request attributes is automatically set by the RouterListener.
     *
     * @return array The parameters
     */
    public function getRouteParams()
    {
<<<<<<< HEAD
        return isset($this->data['request_attributes']['_route_params']) ? $this->data['request_attributes']['_route_params'] : array();
    }

    /**
     * Gets the controller.
     *
     * @return string The controller as a string
=======
        return isset($this->data['request_attributes']['_route_params']) ? $this->data['request_attributes']['_route_params']->getValue() : array();
    }

    /**
     * Gets the parsed controller.
     *
     * @return array|string The controller as a string or array of data
     *                      with keys 'class', 'method', 'file' and 'line'
>>>>>>> git-aline/master/master
     */
    public function getController()
    {
        return $this->data['controller'];
    }

<<<<<<< HEAD
=======
    /**
     * Gets the previous request attributes.
     *
     * @return array|bool A legacy array of data from the previous redirection response
     *                    or false otherwise
     */
    public function getRedirect()
    {
        return isset($this->data['redirect']) ? $this->data['redirect'] : false;
    }

>>>>>>> git-aline/master/master
    public function onKernelController(FilterControllerEvent $event)
    {
        $this->controllers[$event->getRequest()] = $event->getController();
    }

<<<<<<< HEAD
    public static function getSubscribedEvents()
    {
        return array(KernelEvents::CONTROLLER => 'onKernelController');
=======
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        if ($event->getRequest()->cookies->has('sf_redirect')) {
            $event->getRequest()->attributes->set('_redirected', true);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
        );
>>>>>>> git-aline/master/master
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'request';
    }

<<<<<<< HEAD
    private function getCookieHeader($name, $value, $expires, $path, $domain, $secure, $httponly)
    {
        $cookie = sprintf('%s=%s', $name, urlencode($value));

        if (0 !== $expires) {
            if (is_numeric($expires)) {
                $expires = (int) $expires;
            } elseif ($expires instanceof \DateTime) {
                $expires = $expires->getTimestamp();
            } else {
                $tmp = strtotime($expires);
                if (false === $tmp || -1 == $tmp) {
                    throw new \InvalidArgumentException(sprintf('The "expires" cookie parameter is not valid (%s).', $expires));
                }
                $expires = $tmp;
            }

            $cookie .= '; expires='.str_replace('+0000', '', \DateTime::createFromFormat('U', $expires, new \DateTimeZone('GMT'))->format('D, d-M-Y H:i:s T'));
        }

        if ($domain) {
            $cookie .= '; domain='.$domain;
        }

        $cookie .= '; path='.$path;

        if ($secure) {
            $cookie .= '; secure';
        }

        if ($httponly) {
            $cookie .= '; httponly';
        }

        return $cookie;
=======
    /**
     * Parse a controller.
     *
     * @param mixed $controller The controller to parse
     *
     * @return array|string An array of controller data or a simple string
     */
    protected function parseController($controller)
    {
        if (\is_string($controller) && false !== strpos($controller, '::')) {
            $controller = explode('::', $controller);
        }

        if (\is_array($controller)) {
            try {
                $r = new \ReflectionMethod($controller[0], $controller[1]);

                return array(
                    'class' => \is_object($controller[0]) ? \get_class($controller[0]) : $controller[0],
                    'method' => $controller[1],
                    'file' => $r->getFileName(),
                    'line' => $r->getStartLine(),
                );
            } catch (\ReflectionException $e) {
                if (\is_callable($controller)) {
                    // using __call or  __callStatic
                    return array(
                        'class' => \is_object($controller[0]) ? \get_class($controller[0]) : $controller[0],
                        'method' => $controller[1],
                        'file' => 'n/a',
                        'line' => 'n/a',
                    );
                }
            }
        }

        if ($controller instanceof \Closure) {
            $r = new \ReflectionFunction($controller);

            return array(
                'class' => $r->getName(),
                'method' => null,
                'file' => $r->getFileName(),
                'line' => $r->getStartLine(),
            );
        }

        if (\is_object($controller)) {
            $r = new \ReflectionClass($controller);

            return array(
                'class' => $r->getName(),
                'method' => null,
                'file' => $r->getFileName(),
                'line' => $r->getStartLine(),
            );
        }

        return \is_string($controller) ? $controller : 'n/a';
>>>>>>> git-aline/master/master
    }
}
