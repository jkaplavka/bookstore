<?php

declare(strict_types = 1);

namespace App\Entity\Book;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Category;
use App\Repository\Book\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get',
        'post',
    ],
    itemOperations: [
        'get',
        'put',
    ],
    normalizationContext:[
        'groups' => ['book:read'],
        'swagger_definition_name' => 'Read',
    ],
    denormalizationContext:[
        'groups' => ['book:write'],
        'swagger_definition_name' => 'Write',
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'category' => 'exact',
    'name' => 'partial',
])]
#[ORM\Entity(
    repositoryClass: BookRepository::class
)]
class Book
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(['book:read'])]
    private UuidInterface $id;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 200)]
    #[Groups(['book:read', 'book:write'])]
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[Groups(['book:read', 'book:write'])]
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[Assert\NotBlank()]
    #[Assert\GreaterThanOrEqual(value: 0)]
    #[Assert\Type(type: 'float')]
    #[Groups(['book:read', 'book:write'])]
    #[ORM\Column(type: 'float')]
    private float $price;

    #[Assert\NotBlank()]
    #[Assert\GreaterThanOrEqual(value: 0)]
    #[Groups(['book:read', 'book:write'])]
    #[ORM\Column(type: 'integer')]
    private int $stockQuantity;

    #[Assert\NotBlank()]
    #[Groups(['book:read', 'book:write'])]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy:'books', fetch:'EAGER')]
    private Category $category;

    #[Assert\NotBlank()]
    #[Groups(['book:read', 'book:write'])]
    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy:'books', fetch:'EAGER')]
    private Author $author;

    #[Assert\NotBlank()]
    #[Assert\Count(min: 1)]
    #[Groups(['book:read', 'book:write'])]
    #[ORM\ManyToMany(targetEntity: Format::class)]
    private Collection $formats;

    #[Groups(['book:read'])]
    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private ?string $imageFileName;

    public function __construct()
    {
        $this->formats = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStockQuantity(): int
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(int $stockQuantity): self
    {
        $this->stockQuantity = $stockQuantity;

        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImageFileName(): ?string
    {
        return $this->imageFileName;
    }

    public function setImageFileName(?string $imageFileName): self
    {
        $this->imageFileName = $imageFileName;

        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getFormats(): Collection
    {
        return $this->formats;
    }

    public function addFormat(Format $format): self
    {
        if (!$this->formats->contains($format)) {
            $this->formats[] = $format;
        }

        return $this;
    }

    public function removeFormat(Format $format): self
    {
        if ($this->formats->contains($format)) {
            $this->formats->removeElement($format);
        }

        return $this;
    }

}
