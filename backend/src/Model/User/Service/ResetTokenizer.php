<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use App\Model\User\Entity\User\ResetToken;
use DateTimeImmutable;
use DateInterval;
use Exception;
use Ramsey\Uuid\Uuid;

class ResetTokenizer
{
    public const INTERVAL = 'PT1H';
    private DateInterval $interval;

    public function __construct()
    {
        $this->interval = new DateInterval(self::INTERVAL);
    }

    /**
     * @return ResetToken
     * @throws Exception
     */
    public function generate(): ResetToken
    {
        return new ResetToken(
            Uuid::uuid4()->toString(),
            (new DateTimeImmutable())->add($this->interval)
        );
    }
}
