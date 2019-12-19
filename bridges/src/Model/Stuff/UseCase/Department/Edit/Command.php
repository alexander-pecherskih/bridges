<?php


namespace App\Model\Stuff\UseCase\Department\Edit;


use App\Model\Stuff\Entity\Department\Department;

class Command
{
    public $id;
    public $title;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public static function fromGroup(Department $group): self {

        $dto = new self($group->getId());
        $dto->title = $group->getTitle();

        return $dto;
    }
}