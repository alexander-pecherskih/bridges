<?php


namespace App\Model\Process\Entity\Process;


use Webmozart\Assert\Assert;

/**
 * @ORM\Embeddable()
 */
class Title
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}