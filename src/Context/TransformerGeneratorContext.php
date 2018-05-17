<?php
declare(strict_types=1);

namespace Metamorph\Context;

class TransformerGeneratorContext
{
    /** @var array */
    private $config;
    /** @var UsageTypeContext */
    private $from;
    /** @var string */
    private $object;
    /** @var UsageTypeContext */
    private $to;

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): TransformerGeneratorContext
    {
        $this->config = $config;

        return $this;
    }

    public function getFrom(): UsageTypeContext
    {
        return $this->from;
    }

    public function setFrom(UsageTypeContext $from): TransformerGeneratorContext
    {
        $this->from = $from;

        return $this;
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function setObject(string $object): TransformerGeneratorContext
    {
        $this->object = $object;

        return $this;
    }

    public function getTo(): UsageTypeContext
    {
        return $this->to;
    }

    public function setTo(UsageTypeContext $to): TransformerGeneratorContext
    {
        $this->to = $to;

        return $this;
    }
}
