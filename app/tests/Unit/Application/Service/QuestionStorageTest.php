<?php

namespace App\Tests\Unit\Application\Service;

use App\Application\Service\QuestionStorage;
use App\Domain\Factory\QuestionFactory;
use App\Domain\Repository\QuestionRepositoryInterface;
use App\Domain\Storage\QuestionStorageInterface;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class QuestionStorageTest extends TestCase
{
    private QuestionStorage $storage;
    private MockObject $questionStorage;
    private MockObject $questionRepository;


    protected function setUp(): void
    {
        $this->questionStorage = $this->createMock(QuestionStorageInterface::class);
        $this->questionRepository = $this->createMock(QuestionRepositoryInterface::class);

        $this->storage = new QuestionStorage($this->questionStorage, $this->questionRepository);
    }

    public function testGetCurrentPosition(): void
    {
        $expected = 62;

        $this->questionStorage->expects($this->once())
            ->method('getCurrentPosition')
            ->willReturn($expected);

        $this->assertSame($expected, $this->storage->getCurrentPosition());
    }

    /**
     * @dataProvider boolProvider
     */
    public function testGetCurrent(bool $isNull): void
    {
        $currentQuestion = $isNull ? null:(new QuestionFactory())->create('sample_question');

        $this->questionStorage->expects($this->once())
            ->method('getCurrentQuestion')
            ->willReturn($currentQuestion);

        $this->assertSame($currentQuestion, $this->storage->getCurrent());
    }

    /**
     * @dataProvider boolProvider
     */
    public function testGenerate(bool $isEmpty): void
    {
        $sampleQuestions = [4,5,2,1,3];

        $this->questionStorage->expects($this->once())
            ->method('getAll')
            ->willReturn($isEmpty ? []: ['sample_data']);

        $this->questionRepository->expects($isEmpty ? $this->once():$this->never())
            ->method('getQuestions')
            ->willReturn($sampleQuestions);

        $this->questionStorage->expects($isEmpty ? $this->once():$this->never())
            ->method('set')
            ->with(new Callback(function (array $data){
                $this->assertCount(5, $data);

                for($i = 1; $i < 6; $i++ ){
                    $this->assertTrue(in_array($i, $data));
                }

                return true;
            }));

        $this->storage->generate();
    }

    public function testShift(): void
    {
        $this->questionStorage->expects($this->once())
            ->method('removeFirst');

        $this->storage->shift();
    }


    private function boolProvider(): array
    {
        return [
            [true, false]
        ];
    }
}
