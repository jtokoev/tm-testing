<?php

declare(strict_types=1);

namespace App\Infrastructure\Storage\Session;

use App\Domain\Entity\Question;
use App\Domain\Storage\QuestionStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class SessionQuestionStorage implements QuestionStorageInterface
{
    private const QUESTIONS_SESSION_KEY = 'questions_session_key';
    private const QUESTIONS_SESSION_POSITION_KEY = 'questions_session_position_key';

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

        return current($questions);
    }

    public function getCurrentPosition(): int
    {
        return $this->session->get(self::QUESTIONS_SESSION_POSITION_KEY, 1);
    }

    public function set(array $questions): void
    {
        $this->session->set(self::QUESTIONS_SESSION_KEY, $questions);
    }

    public function removeFirst(): void
    {
        $questions = $this->get();

        array_shift($questions);

        if (empty($questions)) {
            $this->clearQuestionPosition();
        }

        $this->set($questions);

        $this->incrQuestionPosition();
    }

    private function incrQuestionPosition(): void
    {
        $this->session->set(self::QUESTIONS_SESSION_POSITION_KEY, $this->getCurrentPosition() + 1);
    }

    private function clearQuestionPosition(): void
    {
        $this->session->set(self::QUESTIONS_SESSION_POSITION_KEY, 0);
    }
}
