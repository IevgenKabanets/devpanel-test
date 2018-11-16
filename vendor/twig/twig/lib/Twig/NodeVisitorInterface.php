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
 * Twig_NodeVisitorInterface is the interface the all node visitor classes must implement.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface Twig_NodeVisitorInterface
{
    /**
     * Called before child nodes are visited.
     *
<<<<<<< HEAD
     * @param Twig_NodeInterface $node The node to visit
     * @param Twig_Environment   $env  The Twig environment instance
     *
=======
>>>>>>> git-aline/master/master
     * @return Twig_NodeInterface The modified node
     */
    public function enterNode(Twig_NodeInterface $node, Twig_Environment $env);

    /**
     * Called after child nodes are visited.
     *
<<<<<<< HEAD
     * @param Twig_NodeInterface $node The node to visit
     * @param Twig_Environment   $env  The Twig environment instance
     *
=======
>>>>>>> git-aline/master/master
     * @return Twig_NodeInterface|false The modified node or false if the node must be removed
     */
    public function leaveNode(Twig_NodeInterface $node, Twig_Environment $env);

    /**
     * Returns the priority for this visitor.
     *
     * Priority should be between -10 and 10 (0 is the default).
     *
     * @return int The priority level
     */
    public function getPriority();
}
<<<<<<< HEAD
=======

class_alias('Twig_NodeVisitorInterface', 'Twig\NodeVisitor\NodeVisitorInterface', false);
class_exists('Twig_Environment');
class_exists('Twig_Node');
>>>>>>> git-aline/master/master
