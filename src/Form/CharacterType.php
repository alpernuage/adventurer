<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Column', IntegerType::class, [
                'label' => 'Starting Y Position:',
                'required' => true,
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Coordinate y must be greater than or equal to 0.',
                    ]),
                ],
            ])
            ->add('Line', IntegerType::class, [
                'label' => 'Starting X Position:',
                'required' => true,
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Coordinate y must be greater than or equal to 0.',
                    ]),
                ],
            ])
            ->add('movements', TextType::class, [
                'label' => 'Movements (NSEO):',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ]);
    }
}
