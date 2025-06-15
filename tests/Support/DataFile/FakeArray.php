<?php

declare(strict_types=1);

return ['stringProp' => 'value-1', 'intProp' => 21, 'floatProp' => 2.1, 'arrayProp' => ['value-1', 'value-2'], 'indexedArrayProp' => ['test-1' => 'value-1', 'test-2' => 'value-2'], 'nestedArrayProp' => ['test-1' => 'nested-value-1', 'test-2' => ['nested-key-2' => 'nested-value-2']], 'classStringProp' => Carbon\CarbonImmutable::class, 'classStringArrayIndexProp' => [Carbon\CarbonImmutable::class => 'value-1']];
