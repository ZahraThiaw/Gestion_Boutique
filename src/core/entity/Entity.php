<?php
// namespace App\Core\Entity;

// use \ReflectionClass;

// abstract class Entity {
//     public function __get($property) {
//         $reflector = new ReflectionClass($this);
//         if ($reflector->hasProperty($property)) {
//             $propertyReflector = $reflector->getProperty($property);
//             $propertyReflector->setAccessible(true);
//             return $propertyReflector->getValue($this);
//         } else {
//             throw new \Exception("Propriété '$property' inexistante dans la classe " . get_class($this));
//         }
//     }

//     public function __set($property, $value) {
//         $reflector = new ReflectionClass($this);
//         if ($reflector->hasProperty($property)) {
//             $propertyReflector = $reflector->getProperty($property);
//             $propertyReflector->setAccessible(true);
//             $propertyReflector->setValue($this, $value);
//         } else {
//             throw new \Exception("Propriété '$property' inexistante dans la classe " . get_class($this));
//         }
//     }

//     public function toArray() {
//         return get_object_vars($this);
//     }
// }



namespace App\Core\Entity;

use \ReflectionClass;

abstract class Entity {
    public function __get($property) {
        $reflector = new ReflectionClass($this);
        if ($reflector->hasProperty($property)) {
            $propertyReflector = $reflector->getProperty($property);
            $propertyReflector->setAccessible(true);
            return $propertyReflector->getValue($this);
        } else {
            throw new \Exception("Propriété '$property' inexistante dans la classe " . get_class($this));
        }
    }

    public function __set($property, $value) {
        $reflector = new ReflectionClass($this);
        if ($reflector->hasProperty($property)) {
            $propertyReflector = $reflector->getProperty($property);
            $propertyReflector->setAccessible(true);
            $propertyReflector->setValue($this, $value);
        } else {
            throw new \Exception("Propriété '$property' inexistante dans la classe " . get_class($this));
        }
    }

    public function toArray() {
        return get_object_vars($this);
    }

    /**
     * Sérialise l'objet en un tableau associatif.
     *
     * @return array Les propriétés de l'objet.
     */
    public function __serialize(): array {
        // Retourne les propriétés de l'objet sous forme de tableau
        return $this->toArray();
    }

    /**
     * Désérialise les données pour réinitialiser l'objet.
     *
     * @param array $data Les données sérialisées.
     */
    public function __unserialize(array $data): void {
        // Attribue les valeurs des propriétés à l'objet
        foreach ($data as $property => $value) {
            $this->__set($property, $value);
        }
    }
}


