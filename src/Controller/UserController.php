<?php


namespace App\Controller;

use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route(path="/user")
 */

class UserController extends AbstractController
{
    /**
     * @Route(path="/create", name="userkontroler")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws
     */

    public function create(Request $request, EntityManagerInterface $entityManager):Response
    {
        if ('POST' === $request->getMethod()){

            $user = new User($request->get('name',''));
            $user->setSurname($request->get('surname'));

            $entityManager->persist($user);
            $entityManager->flush();


        }else{
            $user = new User('');
        }
        return $this->render('user/create.html.twig',['user'=>$user,]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list")
     *
     */
    public function list(EntityManagerInterface $entityManager):Response
    {
        $repository = $entityManager->getRepository(User::class);
        $users = [];
        return $this->render('user/list.html.twig',['users'=>$users]);
    }

}