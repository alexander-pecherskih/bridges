<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Embeddable
 */
class Name
{
    /**
     * @ORM\Column(type="string")
     */
    private string $first;

    /**
     * @ORM\Column(type="string")
     */
    private string $last;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $patronymic = null;

    public function __construct(string $first, string $last, string $patronymic = null)
    {
        Assert::notEmpty($first);
        Assert::notEmpty($last);

        $this->first = $first;
        $this->last = $last;
        $this->patronymic = $patronymic;
    }

    public function getFirst(): string
    {
        return $this->first;
    }

    public function getLast(): string
    {
        return $this->last;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function getFull(): string
    {
        return implode(' ', [$this->last, $this->first, $this->patronymic]);
    }
}
