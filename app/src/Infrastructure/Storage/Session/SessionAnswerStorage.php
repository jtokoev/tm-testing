<?php

declare(strict_types=1);

namespace App\Infrastructure\Storage\Session;

use App\Application\Dto\AnswerDto;
use App\Domain\Storage\AnswerStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class SessionAnswerStorage implements AnswerStorageInterface
{
    private const ANSWERS_SESSION_KEY = 'answers_session_key';

    private readonly SessionInterface $session;

    public function __construct(private readonly RequestStack $requestStack)
    {
        $this->session = $this->requestStack->getSession();
    }

    public function getAll(): array
    {
        return $this->session->get(self::ANSWERS_SESSION_KEY, []);
    }

    public function add(AnswerDto $answerDto): void
    {
        $answers = $this->session->get(self::ANSWERS_SESSION_KEY, []);

        $answers[] = $answerDto;

        $this->session->set(self::ANSWERS_SESSION_KEY, $answers);
    }

    public function clear(): void
    {
        $this->session->set(self::ANSWERS_SESSION_KEY, []);
    }
}
