<?php

namespace Kojirock5260\Entity;

use Kojirock5260\ValueObject\MailAddress;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var MailAddress
     */
    private $email;

    /**
     * @var UserProfile
     */
    private $userProfile;
}