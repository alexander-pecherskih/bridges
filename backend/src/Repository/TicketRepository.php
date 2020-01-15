<?php


namespace App\Repository;

use App\Model\Process\Entity\Ticket\Id;
use App\Model\Process\Entity\Ticket\Ticket;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;

class TicketRepository
{
    private $em;
    private $repo;
    private $connection;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Ticket::class);
        $this->connection = $this->em->getConnection();
    }

    /**
     * @return Id
     * @throws DBALException
     */
    public function nextId(): Id
    {
        return new Id((int) $this->connection->query('SELECT nextval(\'tickets_seq\')')->fetchColumn());
    }
}