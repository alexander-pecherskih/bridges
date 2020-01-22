<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Company;

use Ramsey\Uuid\UuidInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @property UuidInterface $id
 * @property DateTimeImmutable $created
 * @property string $title
 *
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @ORM\Table(name="companies")
 */
class Company
{
    /**
     * @var UuidInterface
     */
    public $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    public $created;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    public $title;

    public function __construct(UuidInterface $id, DateTimeImmutable $created, string $title)
    {
        Assert::notEmpty($title, 'Company title is empty');

        $this->id = $id;
        $this->created = $created;
        $this->title = $title;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
