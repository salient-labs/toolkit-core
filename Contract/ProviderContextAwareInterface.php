<?php declare(strict_types=1);

namespace Salient\Core\Contract;

/**
 * Returns a provider context
 *
 * @template TContext of ProviderContextInterface
 */
interface ProviderContextAwareInterface
{
    /**
     * Get the object's current provider context
     *
     * @return TContext|null
     */
    public function context(): ?ProviderContextInterface;

    /**
     * Get the object's current provider context, or throw an exception if no
     * provider context has been set
     *
     * @return TContext
     */
    public function requireContext(): ProviderContextInterface;
}
