<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

/**
 * @method static from(array $array)
 * @method all()
 */
trait UpdatableDto
{
    public function updateDto(array $data): self
    {
        return self::from([...$this->all(), ...$data]);
    }
}
