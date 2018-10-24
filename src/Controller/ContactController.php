<?php

namespace App\Controller;
use App\Entity\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;




class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        $entityManager = $this -> getDoctrine() ->getManager();
        
        $contact = new Contact();
        $contact->setName('JohnDoe');
        $contact->setEmail('Jd@xxx.com');
        $contact->setMessage('CROSS FINGER LET IT WORK!!!!!');
        $contact->setReceiveTime('test test now');

         // tell Doctrine you want to (eventually) save the Product (no queries yet)
         $entityManager->persist($contact);

         // actually executes the queries (i.e. the INSERT query)
         $entityManager->flush();
 


        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
