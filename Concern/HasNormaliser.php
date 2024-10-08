<?php declare(strict_types=1);

namespace Salient\Core\Concern;

use Salient\Contract\Core\Entity\Normalisable;
use Salient\Utility\Str;

/**
 * Implements Normalisable
 *
 * @see Normalisable
 *
 * @phpstan-require-implements Normalisable
 */
trait HasNormaliser
{
    /**
     * @inheritDoc
     */
    public static function normaliseProperty(
        string $name,
        bool $greedy = true,
        string ...$hints
    ): string {
        return Str::snake($name);
    }
}
