<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ticket")
 * @Config()
 */
class Ticket
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @Assert\Uuid(strict=true)
     * @ConfigField()
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @ConfigField()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @ConfigField()
     */
    private $content;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="authoredTickets")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="uuid")
     */
    private $author;

    /**
     * @var Person[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Person", mappedBy="assignedTickets")
     */
    private $assigned;

    public function __construct()
    {
        $this->assigned = new ArrayCollection();
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return Person
     */
    public function getAuthor(): Person
    {
        return $this->author;
    }

    /**
     * @param Person $author
     */
    public function setAuthor(Person $author): void
    {
        $this->author = $author;
    }

    /**
     * @return Person[]|Collection
     */
    public function getAssigned(): Collection
    {
        return $this->assigned;
    }

    /**
     * @param Person ...$assigned
     */
    public function addAssigned(Person ...$assigned): void
    {
        foreach ($assigned as $person) {
            $this->assigned->add($person);
        }
    }

    /**
     * @param Person ...$assigned
     */
    public function removeAssigned(Person ...$assigned): void
    {
        foreach ($assigned as $person) {
            $this->assigned->removeElement($person);
        }
    }

    /**
     * @param Person[]|Collection $assigned
     */
    public function setAssigned(Collection $assigned): void
    {
        $this->assigned = $assigned;
    }
}
