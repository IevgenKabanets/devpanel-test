<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Exception;

<<<<<<< HEAD
=======
use Psr\Container\NotFoundExceptionInterface;

>>>>>>> git-aline/master/master
/**
 * This exception is thrown when a non-existent service is requested.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
<<<<<<< HEAD
class ServiceNotFoundException extends InvalidArgumentException
{
    private $id;
    private $sourceId;

    public function __construct($id, $sourceId = null, \Exception $previous = null, array $alternatives = array())
    {
        if (null === $sourceId) {
=======
class ServiceNotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
    private $id;
    private $sourceId;
    private $alternatives;

    public function __construct($id, $sourceId = null, \Exception $previous = null, array $alternatives = array(), $msg = null)
    {
        if (null !== $msg) {
            // no-op
        } elseif (null === $sourceId) {
>>>>>>> git-aline/master/master
            $msg = sprintf('You have requested a non-existent service "%s".', $id);
        } else {
            $msg = sprintf('The service "%s" has a dependency on a non-existent service "%s".', $sourceId, $id);
        }

        if ($alternatives) {
<<<<<<< HEAD
            if (1 == count($alternatives)) {
=======
            if (1 == \count($alternatives)) {
>>>>>>> git-aline/master/master
                $msg .= ' Did you mean this: "';
            } else {
                $msg .= ' Did you mean one of these: "';
            }
            $msg .= implode('", "', $alternatives).'"?';
        }

        parent::__construct($msg, 0, $previous);

        $this->id = $id;
        $this->sourceId = $sourceId;
<<<<<<< HEAD
=======
        $this->alternatives = $alternatives;
>>>>>>> git-aline/master/master
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSourceId()
    {
        return $this->sourceId;
    }
<<<<<<< HEAD
=======

    public function getAlternatives()
    {
        return $this->alternatives;
    }
>>>>>>> git-aline/master/master
}
