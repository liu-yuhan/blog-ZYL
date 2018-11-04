<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Controller\BlogArticleController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;


class UserSpaceController extends AbstractController
{
    /**
     * @Route("/u={user}/Allcomment", name="user_space")
     */
    public function showAllComment(Request $request, $user){
          $comment=$this->getDoctrine()
                    ->getRepository(Comment::class)
                    ->findBy(['user'=>$user] );


        return $this->render('user_space/index.html.twig', [
            'userComments' => $comment,
        ]);
    }

    /**
     * @Route("u={user}/Delete/Comment={id}",name="deleteComment")
     */
    public function DeleteComment(Request $request,$id,$user) {
        $comment=$this->getDoctrine()
                      ->getRepository(Comment::class)
                      ->find($id);
        
        $entityManager=$this->getDoctrine()
                            ->getManager();
        $entityManager->remove($comment);
        $entityManager->flush();
       return $this->redirectToRoute('user_space',["user"=> $user]);

    }

    /** 
     * @Route("u={user}/Edit/Comment={id}", name="editComment")
    */
    public function EditComment(Request $request, $id,$user){
        $comment = New Comment();
        $comment=$this->getDoctrine()
                ->getRepository(Comment::class)
                ->find($id);
         $form = $this ->createForm(CommentType::Class, $comment);
         $form->handleRequest($request);
         
                        if($form->isSubmitted()&&$form->isValid()){
                                        $entityManager = $this->getDoctrine()->getManager();
                                        $entityManager->persist($comment);
                                        $entityManager->flush();
                                        return $this->redirectToRoute('user_space',
                                            ['user'=> $user,] 
                                            );
                                            }   

        return $this->render('user_space/edit.html.twig',
                    array('commentForm'=> $form->createView()));

    }



}

