<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class MemberResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'memberResponses')]
    #[ORM\JoinColumn(nullable: false)]
    private Member $member;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Question $question;

    #[ORM\Column]
    private bool $correct;

    #[ORM\OneToMany(mappedBy: 'response', targetEntity: MemberResponseAnswer::class, cascade: ['persist'])]
    private Collection $memberResponseAnswers;

    public function __construct()
    {
        $this->memberResponseAnswers = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function setMember(Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function isCorrect(): bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): self
    {
        $this->correct = $correct;

        return $this;
    }

    public function getMemberResponseAnswers(): Collection
    {
        return $this->memberResponseAnswers;
    }

    public function addUserResponseAnswer(MemberResponseAnswer $memberResponseAnswer): self
    {
        if (!$this->memberResponseAnswers->contains($memberResponseAnswer)) {
            $this->memberResponseAnswers->add($memberResponseAnswer);
            $memberResponseAnswer->setResponse($this);
        }

        return $this;
    }
}
