<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint;


/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity()
 * @UniqueEntity({"name"}, message="There is already an account with this email")
 */

class Category
{
    /**
    * @ORM\Id()
    * @ORM\Column(type="integer")
    * @var int
     *@ORM\GeneratedValue(strategy="AUTO")
     *
    */
    private $id;

    /**
     * @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="category")
     * @var user[]Collection
     */

    private $users;


    public function __construct(string $name)
    {
        $this->users =new ArrayCollection();
        $this->name=$name;
    }

    /**
     * @return user[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    public function addUser(User $user)
    {
        $user->setCategory($this);
        $this->users->add($user);
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString():string
    {
        return $this->name;
    }




}