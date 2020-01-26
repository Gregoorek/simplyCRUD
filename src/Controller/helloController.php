<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class helloController extends AbstractController
{
    /**
     * @Route(path="/index", methods={"GET"}, name="hello")
     * @param string $name
     * @param Request $request
     * @return Response
     * @throws \Exception
     */

    public function hello(string $name ,Request $request):Response
    {
        $helloText = "czesc ".$name;
        $param1 = $request->get('param1', 'jakas wiadomosc');
        return new Response("<html lang='pl'><body><h1>$helloText</h1><p>$param1</p></body></html>");
    }

    /**
     * @Route(path="/redirect/{action}", requirements={"hello|currentDate"} , name="hello2")
     * @param string $action
     * @return RedirectResponse
     * @throws \Exception
     */

    public function moceToAction(string $action):RedirectResponse
    {
        return $this->redirectToRoute($action, ['name'=>'some name']);
    }
}