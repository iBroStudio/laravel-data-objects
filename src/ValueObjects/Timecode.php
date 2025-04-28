<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class Timecode extends ValueObject
{
    private int $hours;

    private int $minutes;

    private float $seconds;

    public function __construct(mixed $value)
    {
        if (Str::contains($value, ':')) {
            $this->fromString($value);
        } elseif (is_float($value)) {
            $this->fromFloat($value);
        } else {
            throw ValidationException::withMessages(['Timecode is invalid.']);
        }

        parent::__construct(
            Str::of((string) $this->hours)
                ->padLeft(2, '0')
                ->append(':')
                ->append(
                    Str::padLeft((string) $this->minutes, 2, '0')
                )
                ->append(':')
                ->append(
                    Str::of(number_format($this->seconds))
                        ->before('.')
                        ->padLeft(2, '0')
                )
                ->append('.')
                ->append(
                    Str::of(number_format($this->seconds, 6))
                        ->after('.')
                )
                ->__toString()
        );
    }

    public function asSeconds(): float
    {
        return $this->seconds + ($this->minutes * 60) + ($this->hours * 3600);
    }

    protected function validate(): void
    {
        parent::validate();

        if ($this->seconds > 59) {
            throw ValidationException::withMessages(['Seconds can not be greater than 59.']);
        }

        if ($this->minutes > 59) {
            throw ValidationException::withMessages(['Minutes can not be greater than 59.']);
        }
    }

    private function fromFloat(float $value): void
    {
        $this->seconds = $value;
        $this->hours = (int) floor($this->seconds / 3600);
        $this->seconds -= $this->hours * 3600;
        $this->minutes = (int) floor($this->seconds / 60);
        $this->seconds -= $this->minutes * 60;
        $this->seconds = round($this->seconds, 6);
    }

    private function fromString(string $value): void
    {
        Str::of($value)
            ->explode(':')
            ->each(function (string $item, int $key) {
                switch ($key) {
                    case 0:
                        $this->hours = (int) $item;
                        break;
                    case 1:
                        $this->minutes = (int) $item;
                        break;
                    case 2:
                        $this->seconds = (float) $item;
                        break;
                    case 3:
                        $this->seconds = $this->seconds + (float) "0.{$item}";
                        break;
                }
            });
    }
}
