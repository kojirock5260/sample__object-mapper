<?php

namespace Kojirock5260\Entity;

use Carbon\CarbonImmutable;

class UserProfile
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CarbonImmutable
     */
    private $birthday;

    /**
     * @var int
     */
    private $sex;
}