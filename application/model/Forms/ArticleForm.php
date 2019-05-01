<?php
namespace App\Model\Forms;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Forms;

class ArticleForm
{
    private $formFactory;

    public function __construct()
    {
        $this->formFactory = Forms::createFormFactoryBuilder()
            ->getFormFactory();
    }

    public function getCreateForm()
    {
        return $this->formFactory->createBuilder()
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->getForm()->createView();
    }
}
