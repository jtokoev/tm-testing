<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\AnswerDto;
use App\Domain\Entity\Member;
use App\Domain\Factory\MemberFactory;
use App\Domain\Factory\MemberResponseAnswerFactory;
use App\Domain\Factory\MemberResponseFactory;
use App\Domain\Repository\AnswerRepositoryInterface;
use App\Domain\Repository\MemberRepositoryInterface;
use App\Domain\Repository\QuestionRepositoryInterface;
use InvalidArgumentException;

class ResultSaver
{
    public function __construct(
        private readonly QuestionRepositoryInterface $questionRepository,
        private readonly AnswerRepositoryInterface $answerRepository,
        private readonly MemberRepositoryInterface $memberRepository
    ) {
    }

    /**
     * @param AnswerDto[] $answers
     */
    public function save(array $answers): Member
    {
        $member = (new MemberFactory())->create();

        foreach ($answers as $answerDto) {
            if (!$answerDto instanceof AnswerDto) {
                throw new InvalidArgumentException();
            }

            $memberResponse = (new MemberResponseFactory())->create();

            $isCorrect = true;

            foreach ($answerDto->answers as $answerId) {
                $answer = $this->answerRepository->findById($answerId);

                $memberAnswer = (new MemberResponseAnswerFactory())->create($answer);

                $memberResponse->addUserResponseAnswer($memberAnswer);

                if (!$answer->isCorrect()) {
                    $isCorrect = false;
                }
            }

            $question = $this->questionRepository->findById($answerDto->questionId);

            $memberResponse->setCorrect($isCorrect);
            $memberResponse->setQuestion($question);

            $member->addMemberResponse($memberResponse);
        }

        $this->memberRepository->save($member);

        return $member;
    }
}
