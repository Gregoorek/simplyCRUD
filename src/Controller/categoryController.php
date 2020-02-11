<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\User;
use App\Type\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class categoryController
 * @package App\Controller
 * @Route(path="/category")
 */

class categoryController extends AbstractController
{
    /**
     * @Route(path="/create", name="category_create")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws
     */

    public function create(Request $request, EntityManagerInterface $entityManager):Response //zapisywanie do bazy
    {
        $category = new Category('');

        $form = $this->createForm(CategoryType::class, $category);              //form generowany przez symf , builder w type\usertype.php

        $form -> handleRequest($request);
        if ($form->isSubmitted()){
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category_list');
        }
        return $this->render('category/create.html.twig',['form'=>$form->createView(),]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list" ,name="category_list")
     */
    public function list(EntityManagerInterface $entityManager):Response //odczytanie z bazy
    {
        $repository = $entityManager->getRepository(Category::class);
        $category = $repository->findAll();

        return $this->render('category/list.html.twig',['category'=>$category]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/delete/{id}" ,name="deleteCategory")
     */

    public function delete(int $id, EntityManagerInterface $entityManager ):Response //usownie uzytkownikow
    {
        $repository = $entityManager->getRepository(Category::class);
        $category = $repository->find($id);    //id przekazane przez adres do funkcji

        $entityManager->remove($category);
        $entityManager->flush();
        return $this->redirectToRoute('category_list');
    }

    /**
     * @param Category $category
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route(path="/edit/{id}", name="editCategory")
     */
    public function edit(Category $category, EntityManagerInterface $entityManager , Request $request):Response //edytowanie danych
    {
        if ('POST' === $request->getMethod()){
            $category->setName($request->get('name',''));

            $entityManager->flush();
            return $this->redirectToRoute('category_list');
        }

        return $this->render('category/edit.html.twig',['category'=>$category,]);
    }
}