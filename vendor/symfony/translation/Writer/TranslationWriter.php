<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Writer;

<<<<<<< HEAD
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Dumper\DumperInterface;
=======
use Symfony\Component\Translation\Dumper\DumperInterface;
use Symfony\Component\Translation\Exception\InvalidArgumentException;
use Symfony\Component\Translation\Exception\RuntimeException;
use Symfony\Component\Translation\MessageCatalogue;
>>>>>>> git-aline/master/master

/**
 * TranslationWriter writes translation messages.
 *
 * @author Michel Salib <michelsalib@hotmail.com>
 */
<<<<<<< HEAD
class TranslationWriter
{
    /**
     * Dumpers used for export.
     *
     * @var array
     */
=======
class TranslationWriter implements TranslationWriterInterface
{
>>>>>>> git-aline/master/master
    private $dumpers = array();

    /**
     * Adds a dumper to the writer.
     *
     * @param string          $format The format of the dumper
     * @param DumperInterface $dumper The dumper
     */
    public function addDumper($format, DumperInterface $dumper)
    {
        $this->dumpers[$format] = $dumper;
    }

    /**
     * Disables dumper backup.
     */
    public function disableBackup()
    {
        foreach ($this->dumpers as $dumper) {
<<<<<<< HEAD
            $dumper->setBackup(false);
=======
            if (method_exists($dumper, 'setBackup')) {
                $dumper->setBackup(false);
            }
>>>>>>> git-aline/master/master
        }
    }

    /**
     * Obtains the list of supported formats.
     *
     * @return array
     */
    public function getFormats()
    {
        return array_keys($this->dumpers);
    }

    /**
     * Writes translation from the catalogue according to the selected format.
     *
<<<<<<< HEAD
     * @param MessageCatalogue $catalogue The message catalogue to dump
     * @param string           $format    The format to use to dump the messages
     * @param array            $options   Options that are passed to the dumper
     *
     * @throws \InvalidArgumentException
     */
    public function writeTranslations(MessageCatalogue $catalogue, $format, $options = array())
    {
        if (!isset($this->dumpers[$format])) {
            throw new \InvalidArgumentException(sprintf('There is no dumper associated with format "%s".', $format));
=======
     * @param MessageCatalogue $catalogue The message catalogue to write
     * @param string           $format    The format to use to dump the messages
     * @param array            $options   Options that are passed to the dumper
     *
     * @throws InvalidArgumentException
     */
    public function write(MessageCatalogue $catalogue, $format, $options = array())
    {
        if (!isset($this->dumpers[$format])) {
            throw new InvalidArgumentException(sprintf('There is no dumper associated with format "%s".', $format));
>>>>>>> git-aline/master/master
        }

        // get the right dumper
        $dumper = $this->dumpers[$format];

<<<<<<< HEAD
        if (isset($options['path']) && !is_dir($options['path'])) {
            mkdir($options['path'], 0777, true);
=======
        if (isset($options['path']) && !is_dir($options['path']) && !@mkdir($options['path'], 0777, true) && !is_dir($options['path'])) {
            throw new RuntimeException(sprintf('Translation Writer was not able to create directory "%s"', $options['path']));
>>>>>>> git-aline/master/master
        }

        // save
        $dumper->dump($catalogue, $options);
    }
<<<<<<< HEAD
=======

    /**
     * Writes translation from the catalogue according to the selected format.
     *
     * @param MessageCatalogue $catalogue The message catalogue to write
     * @param string           $format    The format to use to dump the messages
     * @param array            $options   Options that are passed to the dumper
     *
     * @throws InvalidArgumentException
     *
     * @deprecated since 3.4 will be removed in 4.0. Use write instead.
     */
    public function writeTranslations(MessageCatalogue $catalogue, $format, $options = array())
    {
        @trigger_error(sprintf('The "%s()" method is deprecated since Symfony 3.4 and will be removed in 4.0. Use write() instead.', __METHOD__), E_USER_DEPRECATED);
        $this->write($catalogue, $format, $options);
    }
>>>>>>> git-aline/master/master
}
