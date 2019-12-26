<?php


namespace App\Security;


use App\ReadModel\User\UserFetcher;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 * @package App\Provider
 *
 * @property UserFetcher $userRepository
 */
class UserProvider implements UserProviderInterface
{
    private $userRepository;

    public function __construct(UserFetcher $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username): UserInterface
    {
        $user = $this->userRepository->findAuthUserByUsername($username);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return new UserIdentity(
            $user->id,
            $user->username,
            $user->password,
            $user->role,
            $user->status
        );
    }

    /**
     * Refreshes the user.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @return UserInterface
     * @param UserInterface $identity
     * @throws UnsupportedUserException  if the user is not supported
     * @throws UsernameNotFoundException if the user is not found
     */
    public function refreshUser(UserInterface $identity): UserInterface
    {
        if ( !$identity instanceof UserIdentity ) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($identity))
            );
        }

        $user = $this->userRepository->findAuthUserByUsername($identity->getUsername());

        if (!$user) {
            throw new UsernameNotFoundException(sprintf(
                'Username "%s" does not exist.',
                $identity->getUsername()
            ));
        }

        return new UserIdentity(
            $user->id,
            $user->username,
            $user->password,
            $user->role,
            $user->status
        );
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class): bool
    {
        return $class instanceof UserIdentity;
    }
}