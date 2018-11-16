<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

/**
 * Validates values are identical (===).
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
<<<<<<< HEAD
=======
 * @author Bernhard Schussek <bschussek@gmail.com>
>>>>>>> git-aline/master/master
 */
class IdenticalToValidator extends AbstractComparisonValidator
{
    /**
     * {@inheritdoc}
     */
    protected function compareValues($value1, $value2)
    {
        return $value1 === $value2;
    }
<<<<<<< HEAD
=======

    /**
     * {@inheritdoc}
     */
    protected function getErrorCode()
    {
        return IdenticalTo::NOT_IDENTICAL_ERROR;
    }
>>>>>>> git-aline/master/master
}
