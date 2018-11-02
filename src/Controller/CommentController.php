<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Form\CommentType;
use App\Entity\Comment;
use App\Controller\BlogArticleController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;


class CommentController extends AbstractController
{

    /**
     * @Route("/article={id}/comment", name="comment" )
     */
       
    public function setComment(REQUEST $request, Security $security){
            $blog_id = $request ->attributes ->get('id');
            $article = $this ->getDoctrine() 
                             ->getRepository(BlogPost::class)
                             ->find($blog_id);
            $user_id = $security -> getUser(); 
    
          // 1) build the form
         $comment = new Comment();
         $comment -> setUser($user_id); 
         $comment -> setArticle($article);  
         $form = $this ->createForm(CommentType::Class, $comment);
        // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
         
            if($form->isSubmitted()&&$form->isValid()){
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($comment);
                            $entityManager->flush();
                            return $this->redirectToRoute('show_all_comments_of_article',
                                 ['id'=> $blog_id,] 
                                 );
                                }   

    return $this->render(
            'comment/index.html.twig',
             array('commentForm'=> $form->createView(),)
        );

    }


    /**
     *@Route("/article={id}/comment/all", name="show_all_comments_of_article")
     */
        public function showAllCommentsOfTheArticle(REQUEST $request){
            $blog_id = $request ->attributes ->get('id');
            $comment = $this ->getDoctrine()
                             ->getRepository(Comment::class)
                             ->findBy(['article'=> $blog_id]);
                             

                       if (!$comment) {
                           throw $this->createNotFoundException(
                               'No comment found for blog '.$blog_id );
                        }

            return $this->render('comment/BlogCommentList.html.twig',
                          ["blogComments" => $comment]);

        }


    /**
     *@Route("/test/comment")
     */
     public function autoInjectFakeComment()
{
        $user = $this -> getDoctrine() -> getRepository(User::class) 
        -> find('1');
        $article = $this ->getDoctrine() ->getRepository(BlogPost::class)
        ->find('4');

        $comment = New Comment();
        $comment ->setAuthor("little cat");
        $comment ->setComment("blabla");
        $comment ->setUser($user);
        $comment ->setArticle($article);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();

        return new Response(
         'Saved new comment with id: '. $comment ->getId().
        ' posted by user id: '.$user->getId(User::class).
            'comment about article id: '. $article ->getId(BlogPost::class)
        );
        
     }




}
