<?php

namespace App\Validator;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PeselConstraintValidator extends ConstraintValidator
{
    /**
     * @var int[]
     */
    private array $wages = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

    public function validate(
        mixed $value,
        Constraint $constraint
    ): void {

        if (!$constraint instanceof PeselConstraint) {
            throw new UnexpectedTypeException($constraint, PeselConstraint::class);
        }

        if (null === $value || '' === $value && strlen($value) !== 11 && !is_numeric($value)) {
            return;
        }

        $values = str_split($value);
        $sum = 0;

        foreach ($this->wages as $key => $wage) {
            $sum += ($wage * $values[$key]) % 10;
        }

        if ($values[array_key_last($values)] != (10 - $sum % 10)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
