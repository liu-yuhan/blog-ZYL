<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

      $user = $this -> getDoctrine() 
                    -> getRepository(User::class) 
                    ->find('1');
         
       
       $comment = New Comment();
       $comment ->setAuthor("little cat");
       $comment ->setComment("blabla");
       $comment ->setUser($user);
        $manager->persist($comment);
        $manager->flush();
    }
}
