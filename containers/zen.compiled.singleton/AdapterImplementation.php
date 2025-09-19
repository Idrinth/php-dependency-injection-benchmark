<?php

declare(strict_types=1);

use WoohooLabs\Zen\RuntimeContainer;
use WoohooLabs\Zen\Config\AbstractCompilerConfig;
use WoohooLabs\Zen\Config\AbstractContainerConfig;
use WoohooLabs\Zen\Config\EntryPoint\ClassEntryPoint;
use WoohooLabs\Zen\Config\FileBasedDefinition\FileBasedDefinitionConfig;
use WoohooLabs\Zen\Config\FileBasedDefinition\FileBasedDefinitionConfigInterface;
use WoohooLabs\Zen\Config\Hint\DefinitionHint;
use WoohooLabs\Zen\Config\Preload\PreloadConfig;
use WoohooLabs\Zen\Config\Preload\PreloadConfigInterface;

class AdapterImplementation
{
    private RuntimeContainer $container;
    public function __construct()
    {
        $this->container = new RuntimeContainer(new CompilerConfig());
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}

class CompilerConfig extends AbstractCompilerConfig
{
    public function getContainerNamespace(): string
    {
        return '';
    }
    public function getContainerClassName(): string
    {
        return 'GeneratedContainer';
    }
    public function useConstructorInjection(): bool
    {
        return true;
    }
    public function usePropertyInjection(): bool
    {
        return false;
    }
    public function getPreloadConfig(): PreloadConfigInterface
    {
        return PreloadConfig::disabled();
    }
    public function getFileBasedDefinitionConfig(): FileBasedDefinitionConfigInterface
    {
        return FileBasedDefinitionConfig::disabledGlobally();
    }
    public function getContainerConfigs(): array
    {
        return [new ContainerConfig()];
    }
}

class ContainerConfig extends AbstractContainerConfig
{
    protected function getEntryPoints(): array
    {
        return [
            ClassEntryPoint::create(F06::class),
            ClassEntryPoint::create(P16::class),
            ClassEntryPoint::create(Z26::class),
            ClassEntryPoint::create(FIn06::class),
            ClassEntryPoint::create(PIn16::class),
            ClassEntryPoint::create(ZIn26::class),
        ];
    }

    protected function getDefinitionHints(): array
    {
        $hints = [];
        foreach ([['F', '06'], ['P', '16'], ['Z', '26']] as [$max, $suffix]) {
            foreach (range('A', $max) as $letter) {
                $iface = $letter . 'In' . $suffix;
                $impl = $letter . 'Im' . $suffix;
                $hints[$iface] = DefinitionHint::singleton($impl);
            }
        }
        return $hints;
    }

    protected function getWildcardHints(): array
    {
        return [];
    }
}
