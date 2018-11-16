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

<<<<<<< HEAD
use Symfony\Component\Validator\Context\ExecutionContextInterface;
=======
>>>>>>> git-aline/master/master
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validates a PAN using the LUHN Algorithm.
 *
 * For a list of example card numbers that are used to test this
 * class, please see the LuhnValidatorTest class.
 *
 * @see    http://en.wikipedia.org/wiki/Luhn_algorithm
 *
 * @author Tim Nagel <t.nagel@infinite.net.au>
 * @author Greg Knapp http://gregk.me/2011/php-implementation-of-bank-card-luhn-algorithm/
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class LuhnValidator extends ConstraintValidator
{
    /**
     * Validates a credit card number with the Luhn algorithm.
     *
     * @param mixed      $value
     * @param Constraint $constraint
     *
     * @throws UnexpectedTypeException when the given credit card number is no string
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Luhn) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Luhn');
        }

        if (null === $value || '' === $value) {
            return;
        }

        // Work with strings only, because long numbers are represented as floats
        // internally and don't work with strlen()
<<<<<<< HEAD
        if (!is_string($value) && !(is_object($value) && method_exists($value, '__toString'))) {
=======
        if (!\is_string($value) && !(\is_object($value) && method_exists($value, '__toString'))) {
>>>>>>> git-aline/master/master
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if (!ctype_digit($value)) {
<<<<<<< HEAD
            if ($this->context instanceof ExecutionContextInterface) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(Luhn::INVALID_CHARACTERS_ERROR)
                    ->addViolation();
            } else {
                $this->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(Luhn::INVALID_CHARACTERS_ERROR)
                    ->addViolation();
            }
=======
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Luhn::INVALID_CHARACTERS_ERROR)
                ->addViolation();
>>>>>>> git-aline/master/master

            return;
        }

        $checkSum = 0;
<<<<<<< HEAD
        $length = strlen($value);
=======
        $length = \strlen($value);
>>>>>>> git-aline/master/master

        // Starting with the last digit and walking left, add every second
        // digit to the check sum
        // e.g. 7  9  9  2  7  3  9  8  7  1  3
        //      ^     ^     ^     ^     ^     ^
        //    = 7  +  9  +  7  +  9  +  7  +  3
        for ($i = $length - 1; $i >= 0; $i -= 2) {
<<<<<<< HEAD
            $checkSum += $value{$i};
=======
            $checkSum += $value[$i];
>>>>>>> git-aline/master/master
        }

        // Starting with the second last digit and walking left, double every
        // second digit and add it to the check sum
        // For doubles greater than 9, sum the individual digits
        // e.g. 7  9  9  2  7  3  9  8  7  1  3
        //         ^     ^     ^     ^     ^
        //    =    1+8 + 4  +  6  +  1+6 + 2
        for ($i = $length - 2; $i >= 0; $i -= 2) {
<<<<<<< HEAD
            $checkSum += array_sum(str_split($value{$i} * 2));
        }

        if (0 === $checkSum || 0 !== $checkSum % 10) {
            if ($this->context instanceof ExecutionContextInterface) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(Luhn::CHECKSUM_FAILED_ERROR)
                    ->addViolation();
            } else {
                $this->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(Luhn::CHECKSUM_FAILED_ERROR)
                    ->addViolation();
            }
=======
            $checkSum += array_sum(str_split($value[$i] * 2));
        }

        if (0 === $checkSum || 0 !== $checkSum % 10) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Luhn::CHECKSUM_FAILED_ERROR)
                ->addViolation();
>>>>>>> git-aline/master/master
        }
    }
}
