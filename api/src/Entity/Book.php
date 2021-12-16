<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiFilter(SearchFilter::class, properties: ['nbPages' => 'exact', 'Title' => 'partial'] )]
#[ApiFilter(DateFilter::class, properties: ['createdAt'])]



#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource(
    itemOperations: ['get', 'put' , 'delete',

    'post_publication' => [
        'method' => 'POST',
        'path' => '/books/{id}/publication',
        'controller' => CreateBookPublication::class,
    ]
],

    

    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],

)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups("write")]
    #[ORM\Column(type: 'string', length: 100)]
    private $title;

    #[Groups(["read", "write"])]
    #[ORM\Column(type: 'string', length: 50)]
    private $author;

    #[Groups(["read", "write"])]
    #[ORM\Column(type: 'integer')]
    private $nbPages;

    #[Groups(["read", "write"])]
    #[ORM\Column(type: 'float')]
    private $price;

    #[Groups(["read", "write"])]
    #[ORM\Column(type: 'datetime')]
    private $createdAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getNbPages(): ?int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): self
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
   {
        return $this->createdAt;
   } 

   public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
