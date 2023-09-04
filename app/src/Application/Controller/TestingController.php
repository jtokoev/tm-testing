<?php

namespace App\Application\Controller;

use App\Application\Service\QuestionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'testing_')]
class TestingController extends AbstractController
{
    public function __construct(private readonly QuestionStorage $questionStorage)
    {
    }

    #[Route(name: 'main')]
    public function main(): Response
    {
        $this->questionStorage->generate();
    }

    #[Route('process', 'process')]
    public function process(Request $request): Response
    {
        $currentQuestion = $this->questionStorage->getCurrent();
    }
}