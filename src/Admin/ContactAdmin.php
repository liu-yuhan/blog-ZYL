<?php
// src/Admin/BlogPostAdmin.php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\BlogPost;

Class ContactAdmin extends AbstractAdmin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class)
                   ->add('email', TextType::class)
                   ->add('message', TextType::class);
    }

    public function toString($object)
    {
        return $object instanceof Contact
            ? $object->getMessage()
            : 'Message'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
        ->add('email')
        ->add('message');
    }
    
}