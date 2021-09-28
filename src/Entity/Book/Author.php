<?php

declare(strict_types = 1);

namespace App\Entity\Book;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Book\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['author:read'],
            ],
        ],
    ],
    itemOperations: [
        'get',
    ],
)]
#[ORM\Entity(
    repositoryClass: AuthorRepository::class
)]
class Author
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(['author:read', 'book:read'])]
    private UuidInterface $id;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    #[Groups(['author:read', 'book:read'])]
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy:'author', targetEntity: Book::class, fetch: 'EXTRA_LAZY')]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

}
