<?php

namespace IBroStudio\DataObjects\ValueObjects\Units\Byte;

use ByteUnits;
use IBroStudio\DataObjects\Contracts\UnitValueContract;
use IBroStudio\DataObjects\Enums\ByteUnitEnum;
use IBroStudio\DataObjects\Formatters\ByteFormatter;
use IBroStudio\DataObjects\ValueObjects\ValueObject;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ByteUnit extends ValueObject implements UnitValueContract
{
    public readonly int $bytes;

    protected ByteUnits\System $system;

    public function __construct(mixed $value)
    {
        if ($value instanceof ByteUnits\System) {
            $this->system = $value;
        } else {
            try {
                $this->system = ByteUnits\parse($value);
            } catch (ByteUnits\ParseException $e) {
                throw ValidationException::withMessages([$e->getMessage()]);
            }
        }

        $this->bytes = (int) $this->system->numberOfBytes();

        parent::__construct(
            (float) Str::of(ByteFormatter::format($this->system->format()))
                ->before(self::unit())
                ->value()
        );
    }

    public function withUnit(?ByteUnitEnum $unit = null): string
    {
        return ByteFormatter::format($this->system->format($unit?->name));
    }

    public static function unit(): ?string
    {
        return ByteUnitEnum::B->getLabel();
    }

    public function convertIn(ByteUnitEnum $unit): string
    {
        return $this->withUnit($unit);
    }

    public function isEqualTo(ByteUnit $compare): bool
    {
        return $this->bytes === $compare->bytes;
    }

    public function isLessThanOrEqualTo(ByteUnit $compare): bool
    {
        return $this->bytes <= $compare->bytes;
    }

    public function isLessThan(ByteUnit $compare): bool
    {
        return $this->bytes < $compare->bytes;
    }

    public function isGreaterThanOrEqualTo(ByteUnit $compare): bool
    {
        return $this->bytes >= $compare->bytes;
    }

    public function isGreaterThan(ByteUnit $compare): bool
    {
        return $this->bytes > $compare->bytes;
    }
}
