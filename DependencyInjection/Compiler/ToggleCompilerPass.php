<?php

namespace Gustek\FeatureBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ToggleCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('gustek.features.toggleContainer')) {
            return;
        }

        $definition = $container->getDefinition(
            'gustek.features.toggleContainer'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'gustek.feature.toggle'
        );

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall(
                    'addToggleId',
                    array($attributes['alias'], $id)
                );
            }
        }
    }
}
