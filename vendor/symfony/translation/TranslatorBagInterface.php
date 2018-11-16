<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation;

<<<<<<< HEAD
=======
use Symfony\Component\Translation\Exception\InvalidArgumentException;

>>>>>>> git-aline/master/master
/**
 * TranslatorBagInterface.
 *
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 */
interface TranslatorBagInterface
{
    /**
     * Gets the catalogue by locale.
     *
     * @param string|null $locale The locale or null to use the default
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException If the locale contains invalid characters
     *
     * @return MessageCatalogueInterface
=======
     * @return MessageCatalogueInterface
     *
     * @throws InvalidArgumentException If the locale contains invalid characters
>>>>>>> git-aline/master/master
     */
    public function getCatalogue($locale = null);
}
