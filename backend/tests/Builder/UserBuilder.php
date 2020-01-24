<?php

namespace App\Tests\Builder;

use App\Model\User\Entity\User;
use App\Repository\UserRepository;
use BadMethodCallException;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\UuidInterface;

class UserBuilder
{
    private $id;
    private $created;
    private $name;
    private $email;
    private $hash;
    private $token;
    private $confirmed;
    private $network;
    private $identity;
    private $role;

    /**
     * UserBuilder constructor.
     * @param UuidInterface|null $id
     * @param string|null $first
     * @param string|null $last
     * @param string|null $patronymic
     * @throws Exception
     */
    public function __construct(
        UuidInterface $id = null,
        string $first = null,
        string $last = null,
        string $patronymic = null
    ) {
        $this->id = $id ?? UserRepository::nextId();
        $this->name = new User\Name($first ?? 'First', $last ?? 'Last', $patronymic ?? 'Patronymic');
        $this->created = new DateTimeImmutable();
    }

    /**
     * @return User\User
     * @throws Exception
     */
    public function build(): User\User
    {
        $user = null;

        if ($this->email) {
            $user = User\User::signUpByEmail(
                $this->id,
                $this->created,
                $this->name,
                $this->email,
                $this->hash,
                $this->token
            );

            if ($this->confirmed) {
                $user->confirmSignUp();
            }
        }

        if ($this->network) {
            $user = User\User::signUpByNetwork(
                $this->id,
                $this->created,
                $this->name,
                $this->network,
                $this->identity
            );
        }

        if (!$user) {
            throw new BadMethodCallException('Specify via method.');
        }

        return $user;
    }

    public function confirmed(): self
    {
        $clone = clone $this;
        $clone->confirmed = true;
        return $clone;
    }

    public function withNetwork(string $network = null, string $identity = null): self
    {
        $clone = clone $this;
        $clone->network = $network ?? 'network';
        $clone->identity = $identity ?? 'identity';
        return $clone;
    }

    public function withEmail(string $email = null, string $hash = null, string $token = null): self
    {
        $clone = clone $this;
        $clone->email = new User\Email($email ?? 'trololo@example.com');
        $clone->hash = $hash ?? 'hash';
        $clone->token = $token ?? 'hash';
        return $clone;
    }

    public function withRole(User\Role $role): self
    {
        $clone = clone $this;
        $clone->role = $role;
        return $clone;
    }
}
