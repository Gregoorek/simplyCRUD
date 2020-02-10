<?php


namespace App\Controller;

use App\Entity\User;


use App\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $user = new User('');

        $form = $this->createForm(UserType::class, $user);              //form generowany przez symf , builder w type\usertype.php

        $form -> handleRequest($request);
        if ($form->isSubmitted()){
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_list');
        }
        return $this->render('user/create.html.twig',['form'=>$form->createView(),]);
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