<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\LazyProxy\PhpDumper;

use Symfony\Component\DependencyInjection\Definition;

/**
 * Lazy proxy dumper capable of generating the instantiation logic PHP code for proxied services.
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
interface DumperInterface
{
    /**
     * Inspects whether the given definitions should produce proxy instantiation logic in the dumped container.
     *
<<<<<<< HEAD
     * @param Definition $definition
     *
=======
>>>>>>> git-aline/master/master
     * @return bool
     */
    public function isProxyCandidate(Definition $definition);

    /**
     * Generates the code to be used to instantiate a proxy in the dumped factory code.
     *
     * @param Definition $definition
<<<<<<< HEAD
     * @param string     $id         service identifier
     *
     * @return string
     */
    public function getProxyFactoryCode(Definition $definition, $id);
=======
     * @param string     $id          Service identifier
     * @param string     $factoryCode The code to execute to create the service, will be added to the interface in 4.0
     *
     * @return string
     */
    public function getProxyFactoryCode(Definition $definition, $id/**, $factoryCode = null */);
>>>>>>> git-aline/master/master

    /**
     * Generates the code for the lazy proxy.
     *
<<<<<<< HEAD
     * @param Definition $definition
     *
=======
>>>>>>> git-aline/master/master
     * @return string
     */
    public function getProxyCode(Definition $definition);
}
