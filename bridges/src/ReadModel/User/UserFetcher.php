<?php


namespace App\ReadModel\User;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class UserFetcher
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function existByResetToken(string $token): bool
    {
        return $this->connection->createQueryBuilder()
            ->select('COUNT(*)')
            ->from('users')
            ->where('reset_token_token = :token')
            ->setParameter(':token', $token)
            ->execute()
            ->fetchColumn(0) > 0;
    }

    public function findAuthUserByUsername(string $username): ?AuthUser
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(
                'id',
                'email as username',
                'password_hash AS password',
                'TRIM(CONCAT(name_first, \' \', name_last)) AS name',
                'role',
                'status'
            )
            ->from('users')
            ->where('email = :email')
            ->setParameter(':email', $username)
            ->execute();

        $stmt->setFetchMode(FetchMode::CUSTOM_OBJECT, AuthUser::class);
        $result = $stmt->fetch();

        return $result ?: null;
    }
}