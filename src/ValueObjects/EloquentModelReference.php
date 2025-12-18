<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

final class EloquentModelReference extends ValueObject
{
    public readonly string $class;

    public readonly string|int $id;

    public function __construct(mixed $value)
    {
        if (is_object($value)) {
            $this->class = get_class($value);
            $this->id = $value->id;
        }

        if (is_array($value)) {
            $this->class = $value['class'];
            $this->id = $value['id'];
            $value = call_user_func_array([$this->class, 'find'], [$this->id]);
        }

        parent::__construct($value);
    }

    public function toArray(): array
    {
        return [
            'class' => $this->class,
            'id' => $this->id,
        ];
    }

    protected function validate(): void
    {
        parent::validate();

        if (! $this->value instanceof Model) {
            throw ValidationException::withMessages(['Value is not an instance of Eloquent Model.']);
        }
    }
}
