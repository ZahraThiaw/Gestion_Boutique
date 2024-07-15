<?php
namespace App\Core;

use Symfony\Component\Yaml\Yaml;

class DependencyContainer {
    private $services = [];

    public function __construct($configFile) {
        $this->loadServices($configFile);
    }

    private function loadServices($configFile) {
        $this->services = Yaml::parseFile($configFile)['services'];
    }

    public function get($service) {
        if (!isset($this->services[$service])) {
            throw new \Exception("Service {$service} non trouvé.");
        }

        $class = $this->services[$service]['class'];
        return new $class();
    }
}
