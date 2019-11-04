<?php


namespace Kojirock5260\Caster;


use Helicon\ObjectTypeParser\Parser;
use Helicon\TypeConverter\Resolver;
use Helicon\TypeConverter\TypeCaster\TypeCasterInterface;
use Kojirock5260\ValueObject\ValueObjectInterface;
use Zend\Hydrator\ReflectionHydrator;

class ValueObjectTypeCaster implements TypeCasterInterface
{
    /**
     * @var Resolver
     */
    private $resolver;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var ReflectionHydrator
     */
    private $reflectionHydrator;

    /**
     * @param Resolver           $resolver
     * @param Parser $parser
     * @param ReflectionHydrator $reflectionHydrator
     */
    public function __construct(Resolver $resolver, Parser $parser, ReflectionHydrator $reflectionHydrator)
    {
        $this->resolver = $resolver;
        $this->parser = $parser;
        $this->reflectionHydrator = $reflectionHydrator;
    }

    /**
     * @param $value
     * @param string $type
     * @return mixed|object|\Zend\Hydrator\object
     * @throws \ReflectionException
     */
    public function convert($value, string $type)
    {
        $refClass = new \ReflectionClass($type);
        $schemas = ($this->parser)($type);

        $type = $schemas['value']['type'];
        $convertedValue = $this->resolver->resolve($type)->convert($value, $type);

        return $this->reflectionHydrator->hydrate([
            'value' => $convertedValue,
        ], $refClass->newInstanceWithoutConstructor());
    }

    /**
     * @param string $type
     * @return bool
     * @throws \ReflectionException
     */
    public function supports(string $type): bool
    {
        $refClass = new \ReflectionClass($type);
        if ($refClass->isSubclassOf(ValueObjectInterface::class)) {
            return true;
        }

        return false;
    }
}