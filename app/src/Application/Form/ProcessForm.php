<?php

declare(strict_types=1);

namespace App\Application\Form;

use App\Application\Dto\AnswerDto;
use App\Domain\Entity\Answer;
use App\Domain\Entity\Question;
use InvalidArgumentException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcessForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentQuestion = $options['question'];

        if (!$currentQuestion instanceof Question) {
            throw new InvalidArgumentException(sprintf('Undefined "%s" in options', 'question'));
        }

        $builder
            ->add('answers', ChoiceType::class, [
                'choices' => $this->getAnswers($currentQuestion),
                'multiple' => true,
                'expanded' => 'true',
                'label' => 'Варианты ответов (Вы можете выбрать 1 или несколько ответов)',
            ])
            ->add('questionId', HiddenType::class, [
                'data' => $currentQuestion->getId(),
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Сохранить',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnswerDto::class,
            'question' => null,
        ]);
    }

    private function getAnswers(Question $currentQuestion): array
    {
        $result = [];

        $answers = $currentQuestion->getAnswers()->toArray();

        shuffle($answers);

        /** @var Answer $item */
        foreach ($answers as $item) {
            $result[$item->getText()] = $item->getId();
        }

        return $result;
    }
}
