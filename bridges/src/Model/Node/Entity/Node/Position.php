<?php


namespace App\Model\Node\Entity\Node;


use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Position
 * @package App\Entity\Node
 *
 * @ORM\Embeddable()
 */
class Position
{
    const MAX_TOP = 1080;
    const MAX_LEFT = 1920;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $top;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $left;

    public function __construct(int $top = 0, int $left = 0)
    {
        Assert::greaterThan($top, 0, 'Top position should be a positive integer. Got: %s');
        Assert::lessThan($top, self::MAX_TOP, 'Top position should be less than %s. Got: %s');
        Assert::greaterThan($left, 0, 'Left position should be a positive integer. Got: %s');
        Assert::lessThan($left, self::MAX_LEFT, 'Left position should be less than %s. Got: %s');

        $this->top = $top;
        $this->left = $left;
    }

    public function getTop(): int
    {
        return $this->top;
    }

    public function getLeft(): int
    {
        return $this->left;
    }
}