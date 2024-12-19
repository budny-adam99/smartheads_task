<?php

namespace App\Validator;


use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PeselConstraint extends Constraint
{
    public string $message = 'Pesel nie jest poprawny!';

    public function __construct(?string $mode = null, ?string $message = null, ?array $groups = null)
    {
        parent::__construct([], $groups);

        $this->message = $message ?? $this->message;
    }
}
