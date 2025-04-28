<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Carbon\CarbonInterval;
use IBroStudio\DataObjects\Enums\TimeUnitEnum;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TimeDuration extends ValueObject
{
    private CarbonInterval $duration;

    public function __construct(mixed $value, protected TimeUnitEnum|string|null $unit = null)
    {
        if (! $this->unit instanceof TimeUnitEnum) {
            $this->unit = is_string($this->unit) ?
                TimeUnitEnum::from($this->unit) : TimeUnitEnum::MINUTES;
        }

        if (Str::contains($value, ':')) {
            $this->fromString($value);
        } elseif (is_float($value)) {
            $this->fromFloat($value);
        } else {
            throw ValidationException::withMessages(['TimeDuration is invalid.']);
        }

        parent::__construct(
            (string) $this->duration->total($this->unit->value)
        );
    }

    private function fromFloat(float $value): void
    {
        $this->duration = (new CarbonInterval(null))->add($this->unit->value, $value);
    }

    private function fromString(string $value): void
    {
        if (Str::substrCount($value, ':') > 1) {
            $this->duration = CarbonInterval::createFromFormat('H:i:s', $value);
        } else {
            $this->duration = CarbonInterval::createFromFormat('i:s', $value);
        }
    }

    public function format(bool $short = false): string
    {
        return $this->duration->forHumans(['short' => $short]);
    }

    public function toArray(): array
    {
        return [
            'value' => (float) $this->value,
            'unit' => $this->unit,
        ];
    }
}
