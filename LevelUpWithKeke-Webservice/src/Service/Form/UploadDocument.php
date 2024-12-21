<?php


namespace App\Service\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class UploadDocument extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Document (PDF, Word, Excel)',
                'multiple' => false,
                'attr' => ['accept' => 'pdf/*'],
            ]);
    }
}
