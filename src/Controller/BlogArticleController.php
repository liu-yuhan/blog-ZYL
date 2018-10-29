<?php

namespace App\Controller;
use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BlogArticleController extends AbstractController
{
    /**
    * @Route("/article", name="blogArticle")
     */ 
    public function index()
    {
        $all_articles = $this->getDoctrine()
        ->getRepository(BlogPost::class)
        ->findAll();

    if (!$all_articles) {
        throw $this->createNotFoundException(
            'No article found'
        );
            }
    
        return $this->render('blog_article/list.html.twig', [
            'all_articles' => $all_articles,
        ]);
    }
 



    /**
 * @Route("/entry/{slug}", name="entry")
 */
public function entryAction($slug)
{
    $blogPost = $this->blogPostRepository->findOneBySlug($slug);

    if (!$blogPost) {
        $this->addFlash('error', 'Unable to find entry!');

        return $this->redirectToRoute('index');
    }

    return $this->render('blog_article/entry.html.twig', array(
        'blogPost' => $blogPost
    ));
}

    


    /**
     * @Route("/article/{id}", name="show_blogArticle")
     */
         public function show($id)
                {
                    $article = $this->getDoctrine()
                    ->getRepository(BlogPost::class)
                    ->find($id);

                if (!$article) {
                    throw $this->createNotFoundException(
                        'No article found for id '.$id
                    );
                        }

                //return new Response('Check out this great product: '.$product->getPrice());
                // or render a template
                // in the template, print things with {{ product.name }}
                return $this->render('blog_article/index.html.twig', 
                ['article' => $article,]);
                
                }



}
