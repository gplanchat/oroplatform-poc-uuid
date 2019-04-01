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
 * @ORM\Table(name="person")
 * @Config()
 */
class Person
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
     * @ORM\Column(type="text")
     * @Assert\Uuid()
     * @ConfigField()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\Email
     * @ConfigField()
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\Email
     * @ConfigField()
     */
    private $email;

    /**
     * @var Ticket[]|Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy="author")
     */
    private $authoredTickets;

    /**
     * @var Ticket[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ticket", inversedBy="assigned")
     * @ORM\JoinTable(name="ticket_assigned",
     *     joinColumns={
     *         @ORM\JoinColumn(name="assigned_id", referencedColumnName="uuid")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="ticket_id", referencedColumnName="uuid")
     *     }
     * )
     */
    private $assignedTickets;

    public function __construct()
    {
        $this->authoredTickets = new ArrayCollection();
        $this->assignedTickets = new ArrayCollection();
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Ticket[]|Collection
     */
    public function getAuthoredTickets()
    {
        return $this->authoredTickets;
    }

    /**
     * @param Ticket ...$authoredTickets
     */
    public function addAuthoredTickets(Ticket ...$authoredTickets): void
    {
        foreach ($authoredTickets as $ticket) {
            $this->authoredTickets->add($ticket);
        }
    }

    /**
     * @param Ticket ...$authoredTickets
     */
    public function removeAuthoredTickets(Ticket ...$authoredTickets): void
    {
        foreach ($authoredTickets as $ticket) {
            $this->authoredTickets->removeElement($ticket);
        }
    }

    /**
     * @param Ticket[]|Collection $authoredTickets
     */
    public function setAuthoredTickets(Collection $authoredTickets): void
    {
        $this->authoredTickets = $authoredTickets;
    }

    /**
     * @return Ticket[]|Collection
     */
    public function getAssignedTickets()
    {
        return $this->assignedTickets;
    }

    /**
     * @param Ticket ...$assignedTickets
     */
    public function addAssignedTickets(Ticket ...$assignedTickets): void
    {
        foreach ($assignedTickets as $ticket) {
            $this->assignedTickets->add($ticket);
        }
    }

    /**
     * @param Ticket ...$assignedTickets
     */
    public function removeAssignedTickets(Ticket ...$assignedTickets): void
    {
        foreach ($assignedTickets as $ticket) {
            $this->assignedTickets->removeElement($ticket);
        }
    }

    /**
     * @param Ticket[]|Collection $assignedTickets
     */
    public function setAssignedTickets(Collection $assignedTickets): void
    {
        $this->assignedTickets = $assignedTickets;
    }
}
