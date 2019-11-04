<?php

namespace Kojirock5260\ValueObject;

class MailAddress implements ValueObjectInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * MailAddress constructor.
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        $this->value = $value;
        if (!$this->valid()) {
            throw new \InvalidArgumentException('invalid mail address');
        }
    }

    /**
     * @return string
     */
    public function value():string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function valid():bool
    {
        $result = filter_var($this->value, FILTER_VALIDATE_EMAIL);
        return $result === false ? false : true;
    }
}