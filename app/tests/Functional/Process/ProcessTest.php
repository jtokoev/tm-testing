<?php

namespace App\Tests\Functional\Process;

use App\Domain\Entity\Answer;
use App\Domain\Entity\MemberResponse;
use App\Tests\Functional\TestBaseProcess;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;
use Symfony\Component\HttpFoundation\Request;

class ProcessTest extends TestBaseProcess
{

    private array $checkedAnswers = [];


    public function testProcess(): void
    {
        $this->start();

        $this->process();

        $this->client->followRedirect();

        $this->assertDb();
        $this->assertView();
    }

    public function assertDb(): void
    {
        $responses = $this->getEntityManager()->getRepository(MemberResponse::class)->findAll();

        $this->assertCount(8, $responses);
    }

    public function assertView(): void
    {
        $answerRepository = $this->getEntityManager()->getRepository(Answer::class);
        $countOfCorrect = 0;
        $countOfInCorrect = 0;
        foreach ($this->checkedAnswers as $answers) {
            $isCorrect = !empty($answers);

            foreach ($answers as $answerId) {
                $answer = $answerRepository->find($answerId);

                if (!$answer->isCorrect()) {
                    $isCorrect = false;

                    break;
                }
            }

            $isCorrect ? $countOfCorrect++ : $countOfInCorrect++;
        }


        $page = $this->client->getCrawler();

        $this->assertSame($countOfInCorrect, $page->filter('div[class="alert alert-danger"]')->count());
        $this->assertSame($countOfCorrect, $page->filter('div[class="alert alert-success"]')->count());
    }

    private function process(): void
    {
        $crawler = $this->client->getCrawler();
        $formCrawler = $crawler->filter('form[name="process_form"]');

        if (!$formCrawler->count()) {
            return;
        }

        $form = $formCrawler->form();

        $processForm = $form->get('process_form');
        $questionId = $processForm['questionId']->getValue();

        $answers = $processForm['answers'];

        $randomAnswerKeys = array_rand($answers, rand(2, count($answers)));

        foreach ($answers as $key => $item) {
            if ($item instanceof ChoiceFormField) {
                if (in_array($key, $randomAnswerKeys)) {
                    $item->tick();
                    $this->checkedAnswers[$questionId][] = $item->getValue();
                }
            }
        }

        $this->client->submit($form);

        $this->client->followRedirect();

        if (!str_ends_with($this->client->getCrawler()->getUri(), '/process')) {
            return;
        }

        $this->process();
    }

    private function start(): void
    {
        $this->client->request(Request::METHOD_GET, '/');

        $this->client->followRedirect();

        $this->assertResponseIsSuccessful();
    }
}