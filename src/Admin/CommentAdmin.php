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
use App\Entity\User;

Class CommentAdmin extends AbstractAdmin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->with('Content')
            ->add('author', TextType::class)
            ->add('comment', TextareaType::class)
        ->end()

        ->with('Meta data')
            ->add('article', ModelType::class, [
                'class' => BlogPost::class,
                'property' => 'Title',
            ])
        ->end()
     
    ;
    }

    public function toString($object)
    {
        return $object instanceof Comment
            ? $object->getMessage()
            : 'Message'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('author')
        ->add('comment')
        ->add('article.title');
        
    }
    
}