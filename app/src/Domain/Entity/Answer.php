<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Infrastructure\Repository\AnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private Question $question;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $text;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $correct;

    public function __construct(string $answerText, bool $isCorrect)
    {
        $this->text = $answerText;
        $this->correct = $isCorrect;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function isCorrect(): bool
    {
        return $this->correct;
    }
}
