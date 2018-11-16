<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Extractor;

<<<<<<< HEAD
=======
use Symfony\Component\Translation\Exception\InvalidArgumentException;

>>>>>>> git-aline/master/master
/**
 * Base class used by classes that extract translation messages from files.
 *
 * @author Marcos D. Sánchez <marcosdsanchez@gmail.com>
 */
abstract class AbstractFileExtractor
{
    /**
<<<<<<< HEAD
     * @param string|array $resource files, a file or a directory
=======
     * @param string|array $resource Files, a file or a directory
>>>>>>> git-aline/master/master
     *
     * @return array
     */
    protected function extractFiles($resource)
    {
<<<<<<< HEAD
        if (is_array($resource) || $resource instanceof \Traversable) {
=======
        if (\is_array($resource) || $resource instanceof \Traversable) {
>>>>>>> git-aline/master/master
            $files = array();
            foreach ($resource as $file) {
                if ($this->canBeExtracted($file)) {
                    $files[] = $this->toSplFileInfo($file);
                }
            }
        } elseif (is_file($resource)) {
            $files = $this->canBeExtracted($resource) ? array($this->toSplFileInfo($resource)) : array();
        } else {
            $files = $this->extractFromDirectory($resource);
        }

        return $files;
    }

    /**
     * @param string $file
     *
     * @return \SplFileInfo
     */
    private function toSplFileInfo($file)
    {
        return ($file instanceof \SplFileInfo) ? $file : new \SplFileInfo($file);
    }

    /**
     * @param string $file
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException
     *
     * @return bool
=======
     * @return bool
     *
     * @throws InvalidArgumentException
>>>>>>> git-aline/master/master
     */
    protected function isFile($file)
    {
        if (!is_file($file)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException(sprintf('The "%s" file does not exist.', $file));
=======
            throw new InvalidArgumentException(sprintf('The "%s" file does not exist.', $file));
>>>>>>> git-aline/master/master
        }

        return true;
    }

    /**
     * @param string $file
     *
     * @return bool
     */
    abstract protected function canBeExtracted($file);

    /**
<<<<<<< HEAD
     * @param string|array $resource files, a file or a directory
=======
     * @param string|array $resource Files, a file or a directory
>>>>>>> git-aline/master/master
     *
     * @return array files to be extracted
     */
    abstract protected function extractFromDirectory($resource);
}
