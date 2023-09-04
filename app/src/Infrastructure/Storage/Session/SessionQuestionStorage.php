<?php

declare(strict_types=1);

namespace App\Infrastructure\Storage\Session;

use App\Domain\Entity\Question;
use App\Domain\Storage\QuestionStorageInterface;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class SessionQuestionStorage implements QuestionStorageInterface
{
    private const QUESTIONS_SESSION_KEY = 'questions_session_key';

    private readonly SessionInterface $session;

    public function __construct(private readonly RequestStack $requestStack)
    {
        $this->session = $this->requestStack->getSession();
    }

    public function get(): array
    {
        return $this->session->get(self::QUESTIONS_SESSION_KEY, []);
    }

    public function getCurrentQuestion(): ?Question
    {
        if (empty($questions = $this->get())) {
            return null;
        }

        $question = current($questions);

        if ($question instanceof Question || null === $question) {
            return $question;
        }

        throw new InvalidArgumentException();
    }

    public function set(array $questions): void
    {
        $this->session->set(self::QUESTIONS_SESSION_KEY, $questions);
    }
}
