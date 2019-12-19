<?php

namespace App\Model\User\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTimeImmutable;
use DomainException;
use Exception;


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
class User implements UserInterface
{
    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    /**
     * @var Id
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(name="created", type="datetime_immutable")
     */
    private $created;

    /**
     * @var Email
     * @ORM\Column(type="user_email", unique=true, nullable=true)
     */
    private $email;

    /**
     * @var Name
     * @ORM\Embedded(class="Name", columnPrefix="name_")
     */
    private $name;

    /**
     * @var Role
     * @ORM\Column(type="user_role", nullable=false)
     */
    private $role;

    /**
     * @var null|string
     * @ORM\Column(name="password_hash", type="string", nullable=true)
     */
    private $passwordHash;

    /**
     * @var null|string
     * @ORM\Column(name="confirm_token", type="string", nullable=true)
     */
    private $confirmToken;

    /**
     * @var null|ResetToken
     * @ORM\Embedded(class="ResetToken", columnPrefix="reset_token_")
     */
    private $resetToken;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=16, nullable=false)
     */
    private $status;

    /**
     * @var ArrayCollection|Network[]
     *
     * @ORM\OneToMany(targetEntity="Network", mappedBy="user", orphanRemoval=true, cascade={"persist"})
     */
    private $networks;

    private function __construct(Id $id, DateTimeImmutable $created, Name $name)
    {
        $this->id = $id;
        $this->created = $created;
        $this->name = $name;
        $this->role = Role::user();
        $this->networks = new ArrayCollection();
    }

    public static function create(
        Id $id,
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
        Id $id,
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
     * @param Id $id
     * @param DateTimeImmutable $created
     * @param Name $name
     * @param string $networkName
     * @param string $identity
     * @return User
     * @throws Exception
     */
    public static function signUpByNetwork(
        Id $id,
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

    public function changeRole(Role $role): void
    {
        if ($this->role->is($role)) {
            throw new DomainException('Role is already same');
        }

        $this->role = $role;
    }

    public function getId(): Id
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


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->email->getValue();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
