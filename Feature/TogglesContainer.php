<?php

namespace Gustek\FeatureBundle\Feature;

use Gustek\FeatureBundle\FeatureToggle\FeatureToggleInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TogglesContainer
 *
 * @author Gustek
 */
class TogglesContainer {

    /** @var string[] */
    private $toggles = array();

    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function addToggleId($alias, $serviceId) {
        if (isset($this->toggles[$alias])) {
            //TODO create own exception
            throw new Exception($alias . ' toggle taken');
        }
        $this->toggles[$alias] = $serviceId;
    }

    /**
     * @param $alias
     * @return FeatureToggleInterface
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    public function getToggle($alias) {
        if (!isset($this->toggles[$alias])) {
            //TODO create own exception
            throw new Exception($alias . 'doent exists');
        }
        return $this->container->get($this->toggles[$alias]);
    }

} 
