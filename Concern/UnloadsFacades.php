<?php declare(strict_types=1);

namespace Salient\Core\Concern;

use Salient\Contract\Core\Facade\FacadeAwareInterface;
use Salient\Contract\Core\Facade\FacadeInterface;
use Salient\Contract\Core\Instantiable;
use Salient\Utility\Get;
use LogicException;

/**
 * Implements FacadeAwareInterface by maintaining a list of facades the instance
 * is being used by
 *
 * @api
 *
 * @template TService of Instantiable
 *
 * @phpstan-require-implements FacadeAwareInterface
 */
trait UnloadsFacades
{
    /**
     * Normalised FQCN => given FQCN
     *
     * @var array<class-string<FacadeInterface<TService>>,class-string<FacadeInterface<TService>>>
     */
    private $Facades = [];

    /**
     * @param class-string<FacadeInterface<TService>> $facade
     */
    final public function withFacade(string $facade)
    {
        $this->Facades[Get::fqcn($facade)] = $facade;
        return $this;
    }

    /**
     * @param class-string<FacadeInterface<TService>> $facade
     */
    final public function withoutFacade(string $facade, bool $unloading)
    {
        if ($unloading) {
            unset($this->Facades[Get::fqcn($facade)]);
        }
        return $this;
    }

    /**
     * Unload any facades where the object is the underlying instance
     */
    final protected function unloadFacades(): void
    {
        if (!$this->Facades) {
            return;
        }

        foreach ($this->Facades as $fqcn => $facade) {
            if (!$facade::isLoaded() || $facade::getInstance() !== $this) {
                // @codeCoverageIgnoreStart
                unset($this->Facades[$fqcn]);
                continue;
                // @codeCoverageIgnoreEnd
            }

            $facade::unload();
        }

        if (!$this->Facades) {
            return;
        }

        // @codeCoverageIgnoreStart
        throw new LogicException(sprintf(
            'Underlying %s not unloaded: %s',
            static::class,
            implode(' ', $this->Facades),
        ));
        // @codeCoverageIgnoreEnd
    }
}
