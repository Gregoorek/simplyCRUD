<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity()
 */

class Category
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;


    /**
     * @ORM\Column(type="string")
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




}