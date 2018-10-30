<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Form\CommentType;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends AbstractController
{
    

  
    /**
     * @Route("/comment", name="comment")
     */ 
    public function getComment(REQUEST $request){
          // 1) build the form
        $comment = new Comment();
        $form = $this ->createForm(CommentType::Class, $comment);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        
        return $this->redirectToRoute('blogArticle');
        }   

    return $this->render(
            'comment/index.html.twig',
             array('commentForm'=> $form->createView(),)
        );

    }
}
