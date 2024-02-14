<?php declare(strict_types=1);

namespace Salient\Core\Facade;

use Salient\Core\AbstractFacade;
use Salient\Core\ConfigurationManager;

/**
 * A facade for ConfigurationManager
 *
 * @method static array<string,mixed[]> all() Get all configuration values
 * @method static mixed get(string $key, mixed $default = null) Get a configuration value (see {@see ConfigurationManager::get()})
 * @method static array<string,mixed> getMany(array<string|int,mixed|string> $keys) Get multiple configuration values (see {@see ConfigurationManager::getMany()})
 * @method static bool has(string $key) Check if a configuration value exists
 * @method static ConfigurationManager loadDirectory(string $directory) Load values from files in a directory
 *
 * @api
 *
 * @extends AbstractFacade<ConfigurationManager>
 *
 * @generated
 */
final class Config extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getService()
    {
        return ConfigurationManager::class;
    }
}
