<?php


namespace App\Model\User\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Exception;

/**
 * Class Network
 * @package App\Model\User\Entity\User
 *
 * @ORM\Entity()
 * @ORM\Table(name="user_networks", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"name", "identity"})
 * })
 */
class Network
{
    /**
     * @var string
     *
     * @ORM\Column(type="guid")
     * @ORM\Id
     */
    public $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="networks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    public $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    public $identity;

    /**
     * Network constructor.
     * @param User $user
     * @param string $name
     * @param string $identity
     * @throws Exception
     */
    public function __construct(User $user, string $name, string $identity)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->user = $user;
        $this->name = $name;
        $this->identity = $identity;
    }

    public function isForNetwork(string $network): bool
    {
        return $this->getName() === $network;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }


}