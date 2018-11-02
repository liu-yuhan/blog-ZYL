<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */ 
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

/*
Exemple d'utilisation:
my_comment->setAuthor("jean michel");
my_comment->setComment("tructruc");

my_comment
    -> setAuthor("jean michel")
    -> setComment("tructruc");

*/

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user_id): self
    {
        $this->user = $user_id;

        return $this;
    }

    public function getArticle(): ?BlogPost
    {
        return $this->article;
    }

    public function setArticle(?BlogPost $article_id): self
    {
        $this->article = $article_id;

        return $this;
    }
}
