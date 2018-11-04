<?php

namespace App\Controller;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
                                                /*
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
                                            */
        public function new(Request $request)
        {
          
                  $contact = new Contact();
                    // createFormBuilder is a shortcut to get the "form factory"
                    // and then call "createBuilder()" on it
                        $form = $this -> createFormBuilder($contact)
                        ->add('name')
                        ->add('email')
                        ->add('message')
                        ->getForm();

                    $form->handleRequest($request);

                    if ($form->isSubmitted() && $form->isValid()) {
                        $contact = $form->getData();        

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager -> persist($contact);
                        $entityManager->flush();
                    return $this->redirectToRoute('index');
                    }

            return $this->render('contact/index.html.twig', array(
                'contactForm' => $form->createView(),
                ));
        }
    



  
    /**
 * @Route("/message/{id}", name="contact_show")
 */
                public function show($id)
                {
                    $contact = $this->getDoctrine()
                        ->getRepository(Contact::class)
                        ->find($id);

                    if (!$contact) {
                        throw $this->createNotFoundException(
                            'No message found for id '.$id
                        );
                    }

                    return $this->render('contact/show.html.twig', [
                        'contact' => $contact,
                        'controller_name' => 'ContactController',
                    ]);

                    // or render a template
                    // in the template, print things with {{ contact.name }}
                    // return $this->render('product/show.html.twig', ['contact' => $product]);
                }

}

