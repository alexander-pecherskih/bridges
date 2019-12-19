<?php


namespace App\Tests\Builder;


use App\Entity\Process;
use App\Model\User\Entity\User\User;

class ProcessBuilder
{
    private $id;
    private $title;

    public function __construct()
    {
        $this->title = 'Process';
        $this->id = 1;
    }

    public function build(User $owner): Process
    {
        return new Process($this->id, $this->title, $owner);
    }
}