<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class MemberResponseAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'memberResponseAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private MemberResponse $response;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Answer $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getResponse(): MemberResponse
    {
        return $this->response;
    }

    public function setResponse(MemberResponse $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getAnswer(): Answer
    {
        return $this->answer;
    }
}
