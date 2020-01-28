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
     * @Route(path="/create", name="user_create")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws
     */

    public function create(Request $request, EntityManagerInterface $entityManager):Response //zapisywanie do bazy
    {
        if ('POST' === $request->getMethod()){

            $user = new User($request->get('name',''));
            $user->setSurname($request->get('surname'));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_list');   //przekeirowanie na inny route

        }else{
            $user = new User('');
        }
        return $this->render('user/create.html.twig',['user'=>$user,]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list" ,name="user_list")
     */
    public function list(EntityManagerInterface $entityManager):Response //odczytanie z bazy
    {
        $repository = $entityManager->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('user/list.html.twig',['users'=>$users]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/delete/{id}" ,name="delete")
     */

    public function delete(int $id, EntityManagerInterface $entityManager ):Response //usownie uzytkownikow
    {
        $repository = $entityManager->getRepository(User::class);
        $user = $repository->find($id);    //id przekazane przez adres do funkcji

        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('user_list');
    }

    /**
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route(path="/edit/{id}", name="edit")
     */
    public function edit(User $user, EntityManagerInterface $entityManager , Request $request):Response //edytowanie danych
    {
        if ('POST' === $request->getMethod()){
            $user->setName($request->get('name',''));
            $user->setSurname($request->get('surname',''));
            $entityManager->flush();
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig',['user'=>$user,]);
    }
}