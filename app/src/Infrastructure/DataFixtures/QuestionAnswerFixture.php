<?php

declare(strict_types=1);

namespace App\Infrastructure\DataFixtures;

use App\Domain\Factory\AnswerFactory;
use App\Domain\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Webmozart\Assert\Assert;

final class QuestionAnswerFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (self::exampleData() as $question => $data) {
            $question = (new QuestionFactory())->create($question);

            foreach ($data as $datum) {
                $isCorrect = $datum['isCorrect'] ?? null;
                $answerText = $datum['value'] ?? null;

                Assert::boolean($isCorrect);
                Assert::string($answerText);

                $answer = (new AnswerFactory())->create($answerText, $isCorrect);

                $question->addAnswer($answer);
            }

            $manager->persist($question);
        }

        $manager->flush();
    }

    public static function exampleData(): array
    {
        return [
            '1 + 1' => [
                [
                    'value' => '3',
                    'isCorrect' => false,
                ],
                [
                    'value' => '2',
                    'isCorrect' => true,
                ],
                [
                    'value' => '0',
                    'isCorrect' => false,
                ],
            ],
            '2 + 2' => [
                [
                    'value' => '4',
                    'isCorrect' => true,
                ],
                [
                    'value' => '3 + 1',
                    'isCorrect' => true,
                ],
                [
                    'value' => '10',
                    'isCorrect' => false,
                ],
            ],
            '3 + 3' => [
                [
                    'value' => '1 + 5',
                    'isCorrect' => true,
                ],
                [
                    'value' => '1',
                    'isCorrect' => false,
                ],
                [
                    'value' => '6',
                    'isCorrect' => true,
                ], [
                    'value' => '2 + 4',
                    'isCorrect' => true,
                ],
            ],
            '4 + 4' => [
                [
                    'value' => '8',
                    'isCorrect' => true,
                ],
                [
                    'value' => '4',
                    'isCorrect' => false,
                ],
                [
                    'value' => '0',
                    'isCorrect' => false,
                ], [
                    'value' => '0 + 8',
                    'isCorrect' => true,
                ],
            ],
            '5 + 5' => [
                [
                    'value' => '6',
                    'isCorrect' => false,
                ],
                [
                    'value' => '18',
                    'isCorrect' => false,
                ],
                [
                    'value' => '10',
                    'isCorrect' => true,
                ],
                [
                    'value' => '9',
                    'isCorrect' => false,
                ], [
                    'value' => '0',
                    'isCorrect' => false,
                ],
            ],
            '6 + 6' => [
                [
                    'value' => '3',
                    'isCorrect' => false,
                ],
                [
                    'value' => '9',
                    'isCorrect' => false,
                ],
                [
                    'value' => '0',
                    'isCorrect' => false,
                ],
                [
                    'value' => '12',
                    'isCorrect' => true,
                ], [
                    'value' => '5+7',
                    'isCorrect' => true,
                ],
            ],
            '7 + 7' => [
                [
                    'value' => '5',
                    'isCorrect' => false,
                ],
                [
                    'value' => '14',
                    'isCorrect' => true,
                ],
            ],
            '8 + 8' => [
                [
                    'value' => '16',
                    'isCorrect' => true,
                ],
                [
                    'value' => '12',
                    'isCorrect' => false,
                ],
                [
                    'value' => '9',
                    'isCorrect' => false,
                ],
                [
                    'value' => '5',
                    'isCorrect' => false,
                ],
            ],
        ];
    }
}
