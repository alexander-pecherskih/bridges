<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use DomainException;
use Exception;
use Ramsey\Uuid\UuidInterface;

/**
 * Class User
 * @package App\Model\User\Entity\User
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="users", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"email"}),
 *     @ORM\UniqueConstraint(columns={"reset_token_token"}),
 *     @ORM\UniqueConstraint(columns={"confirm_token"})
 * })
 */
class User
{
    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(name="created", type="datetime_immutable")
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\Column(type="user_email", unique=true, nullable=true)
     */
    private ?Email $email = null;

    /**
     * @ORM\Embedded(class="Name", columnPrefix="name_")
     */
    private Name $name;

    /**
     * @ORM\Column(type="user_role", nullable=false)
     */
    private Role $role;

    /**
     * @var null|string
     * @ORM\Column(name="password_hash", type="string", nullable=true)
     */
    private ?string $passwordHash = null;

    /**
     * @var null|string
     * @ORM\Column(name="confirm_token", type="string", nullable=true)
     */
    private ?string $confirmToken = null;

    /**
     * @var null|ResetToken
     * @ORM\Embedded(class="ResetToken", columnPrefix="reset_token_")
     */
    private ?ResetToken $resetToken = null;

    /**
     * @ORM\Column(type="user_email", name="new_email", nullable=true)
     */
    private ?Email $newEmail;
    /**
     * @ORM\Column(type="string", name="new_email_token", nullable=true)
     */
    private ?string $newEmailToken;

    /**
     * @ORM\Column(name="status", type="string", length=16, nullable=false)
     */
    private string $status;

    /**
     * @var Collection|Network[]
     *
     * @ORM\OneToMany(targetEntity="Network", mappedBy="user", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $networks;

    private function __construct(UuidInterface $id, DateTimeImmutable $created, Name $name)
    {
        $this->id = $id;
        $this->created = $created;
        $this->name = $name;
        $this->role = Role::user();
        $this->networks = new ArrayCollection();
    }

    public static function create(
        UuidInterface $id,
        DateTimeImmutable $created,
        Name $name,
        Email $email,
        string $hash
    ): self {
        $user = new self($id, $created, $name);
        $user->email = $email;
        $user->passwordHash = $hash;
        $user->status = self::STATUS_ACTIVE;
        return $user;
    }

    public static function signUpByEmail(
        UuidInterface $id,
        DateTimeImmutable $created,
        Name $name,
        Email $email,
        string $hash,
        string $token
    ): self {
        $user = new self($id, $created, $name);
        $user->email = $email;
        $user->passwordHash = $hash;
        $user->confirmToken = $token;
        $user->status = self::STATUS_WAIT;
        return $user;
    }

    /**
     * @param UuidInterface $id
     * @param DateTimeImmutable $created
     * @param Name $name
     * @param string $networkName
     * @param string $identity
     * @return User
     * @throws Exception
     */
    public static function signUpByNetwork(
        UuidInterface $id,
        DateTimeImmutable $created,
        Name $name,
        string $networkName,
        string $identity
    ): self {
        $user = new self($id, $created, $name);
        $user->status = self::STATUS_ACTIVE;
        $user->attachNetwork($networkName, $identity);
        return $user;
    }

    /**
     * @param string $networkName
     * @param string $identity
     * @throws Exception
     */
    public function attachNetwork(string $networkName, string $identity): void
    {
        foreach ($this->networks as $network) {
            if ($network->isForNetwork($networkName)) {
                throw new DomainException('Network is already attached');
            }
        }

        $this->networks->add(new Network($this, $networkName, $identity));
    }

    public function confirmSignUp(): void
    {
        if (!$this->isWait()) {
            throw new DomainException('User is already confirmed');
        }

        $this->status = self::STATUS_ACTIVE;
        $this->confirmToken = null;
    }

    public function requestPasswordReset(ResetToken $token, DateTimeImmutable $date): void
    {
        if (!$this->isActive()) {
            throw new DomainException('User is not active');
        }

        if (!$this->email) {
            throw new DomainException('Email is not specified');
        }

        if ($this->resetToken && !$this->resetToken->isExpiredTo($date)) {
            throw new DomainException('Resetting is already requested');
        }

        $this->resetToken = $token;
    }

    public function resetPassword(string $passwordHash, DateTimeImmutable $date): void
    {
        if (!$this->resetToken) {
            throw new DomainException('Resetting password not requested');
        }

        if ($this->resetToken->isExpiredTo($date)) {
            throw new DomainException('Reset token is expired');
        }

        $this->passwordHash = $passwordHash;
        $this->resetToken = null;
    }

    public function requestEmailChanging(Email $email, string $token): void
    {
        if (!$this->isActive()) {
            throw new DomainException('User is not active');
        }
        if ($this->email && $this->email->isEqual($email)) {
            throw new DomainException('Email is already same');
        }
        $this->newEmail = $email;
        $this->newEmailToken = $token;
    }

    public function confirmEmailChanging(string $token): void
    {
        if (!$this->newEmailToken) {
            throw new DomainException('Changing is not requested');
        }
        if ($this->newEmailToken !== $token) {
            throw new DomainException('Incorrect changing token');
        }
        $this->email = $this->newEmail;
        $this->newEmail = null;
        $this->newEmailToken = null;
    }

    public function changeRole(Role $role): void
    {
        if ($this->role->is($role)) {
            throw new DomainException('Role is already same');
        }

        $this->role = $role;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    public function getConfirmToken(): ?string
    {
        return $this->confirmToken;
    }

    /**
     * @return Network[]
     */
    public function getNetworks(): array
    {
        return $this->networks->toArray();
    }

    public function getResetToken(): ?ResetToken
    {
        return $this->resetToken;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isBlocked(): bool
    {
        return $this->status === self::STATUS_BLOCKED;
    }

    /**
     * @ORM\PostLoad()
     */
    public function checkEmbeds(): void
    {
        if (!$this->resetToken->getToken()) {
            $this->resetToken = null;
        }
    }
}
