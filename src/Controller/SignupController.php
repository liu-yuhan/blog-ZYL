<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SignupController extends AbstractController
{
    /**
     * @Route("/Signup", name="Signup")
     */
    
    public function index()
    {
        return $this->render('signup/index.html.twig', [
            'controller_name' => 'SignupController',
        ]); 
    }
}
