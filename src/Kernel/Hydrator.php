<?php
declare(strict_types=1);

namespace App\Kernel;

use ReflectionClass;

class Hydrator
{
    private array $reflectionClassMap;

    public function hydrate($class, array $data)
    {
        $reflection = $this->getReflectionClass($class);
        $target = $reflection->newInstanceWithoutConstructor();
        foreach ($data as $name => $value) {
            $property = $reflection->getProperty($name);
            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }
            $property->setValue($target, $value);
        }

        return $target;
    }

    private function getReflectionClass($className): ReflectionClass
    {
        if (!isset($this->reflectionClassMap[$className])) {
            $this->reflectionClassMap[$className] = new ReflectionClass($className);
        }

        return $this->reflectionClassMap[$className];
    }

    public function setPropertyValue(object $object, string $name, $value)
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($name);
        if ($property->isPrivate() || $property->isProtected()) {
            $property->setAccessible(true);
        }
        $property->setValue($object, $value);
    }
}
