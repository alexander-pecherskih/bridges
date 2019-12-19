<?php


namespace App\Tests\Builder;


use App\Model\User\Entity\User;
use BadMethodCallException;
use DateTimeImmutable;

class UserBuilder
{
    private $id;
    private $created;
    private $name;
    private $email;
    private $group;
    private $confirmed;
    private $network;
    private $identity;
//    private $role;

    public function __construct(int $id = null, string $first = null, string $last = null, string $patronymic = null)
    {
        $this->id = new User\Id($id ?? 1);
        $this->name = new User\Name($first ?? 'First', $last ?? 'Last', $patronymic ?? 'Patronymic');
        $this->created = new DateTimeImmutable();
    }

    public function build(): User\User
    {
        $user = null;

        if ($this->email) {
            $user = User\User::signUpByEmail(
                $this->id,
                $this->created,
                $this->name,
                $this->email,
                'hash',
                'token'
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

    public function withEmail(string $email = null): self
    {
        $clone = clone $this;
        $clone->email = new User\Email($email ?? 'trololo@example.com');
        return $clone;
    }

    public function withGroup(Group $group): self
    {
        $clone = clone $this;
        $clone->group = $group;
        return $clone;
    }
}