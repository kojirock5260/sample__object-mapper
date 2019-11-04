<?php

include_once 'vendor/autoload.php';

$data = [
    'id'    => 100,
    'email' => 'example@gmail.com',
    'userProfile'  => [
        'id'       => 1,
        'userId'   => 1,
        'name'     => 'kojirock',
        'birthday' => '1990-01-01',
        'sex'      => 2,
    ]
];

$parser = new \Helicon\ObjectTypeParser\Parser();
$resolver = new \Helicon\TypeConverter\Resolver();
$hydrator = new \Zend\Hydrator\ReflectionHydrator();

$resolver->addConverter(new \Helicon\TypeConverter\TypeCaster\ScalarTypeCaster());
$resolver->addConverter(new \Kojirock5260\Caster\CarbonTypeCaster());
$resolver->addConverter(new \Kojirock5260\Caster\ValueObjectTypeCaster($resolver, $parser, $hydrator));
$resolver->addConverter(new \Helicon\TypeConverter\TypeCaster\ClassTypeCaster($resolver, $parser, $hydrator));
$converter = new \Helicon\TypeConverter\Converter($resolver);

$mapper = new \Helicon\ObjectMapper\ObjectMapper($converter, $parser, $hydrator);
$user   = ($mapper)($data, \Kojirock5260\Entity\User::class);

var_dump($user);die();

