<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Dto\AnswerDto;
use App\Application\Form\ProcessForm;
use App\Application\Service\AnswerStorage;
use App\Application\Service\QuestionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'testing_')]
class TestingController extends AbstractController
{
    public function __construct(private readonly QuestionStorage $questionStorage, private readonly AnswerStorage $answerStorage)
    {
    }

    #[Route(name: 'main')]
    public function main(): Response
    {
        $this->questionStorage->generate();

        return $this->redirectToRoute('testing_process');
    }

    #[Route('process', 'process')]
    public function process(Request $request): Response
    {
        $currentQuestion = $this->questionStorage->getCurrent();

        if (null === $currentQuestion) {
            return $this->redirectToRoute('testing_main');
        }

        $form = $this->createForm(type: ProcessForm::class, options: [
            'question' => $currentQuestion,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var AnswerDto $answerDto */
            $answerDto = $form->getData();

            $answerDto->question = $currentQuestion->getId();

            $this->answerStorage->addAnswer($answerDto);

            $this->questionStorage->shift();

            return $this->redirectToRoute('testing_process');
        }

        return $this->render('testing/process.html.twig', [
            'form' => $form,
            'currentQuestionText' => $currentQuestion->getText(),
            'questionNum' => 1,
        ]);
    }
}
