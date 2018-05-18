<?php
declare(strict_types=1);

namespace Metamorph\Context;

class UsageTypeContext
{
    /** @var string */
    private $class;
    /** @var array */
    private $getters;
    /** @var string */
    private $name;
    /** @var string */
    private $namespace;
    /** @var string */
    private $path;
    /** @var array */
    private $properties;
    /** @var array */
    private $setters;
    /** @var string */
    private $usage;

    public function getClass(): string
    {
        return $this->class;
    }

    public function isClass(): bool
    {
        return !empty($this->class);
    }

    public function setClass(?string $class): UsageTypeContext
    {
        $this->class = $class;

        return $this;
    }

    public function getGetter(string $property): string
    {
        return $this->getters[$property];
    }

    public function getGetters(): array
    {
        return $this->getters;
    }

    public function setGetters(array $getters): UsageTypeContext
    {
        $this->getters = $getters;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UsageTypeContext
    {
        $this->name = $name;

        return $this;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): UsageTypeContext
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): UsageTypeContext
    {
        $this->path = $path;

        return $this;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function setProperties(array $properties): UsageTypeContext
    {
        $this->properties = $properties;

        return $this;
    }

    public function getSetters(): array
    {
        return $this->setters;
    }

    public function setSetters(array $setters): UsageTypeContext
    {
        $this->setters = $setters;

        return $this;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }

    public function setUsage(string $usage): UsageTypeContext
    {
        $this->usage = $usage;

        return $this;
    }
}
