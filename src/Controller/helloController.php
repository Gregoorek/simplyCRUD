<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class helloController
 * @package App\Controller
 * @Route("/page")
 */
class helloController extends AbstractController
{
    /**
     * @Route(path="/hi/{name}", name="hello")
     * @param string $name
     * @param Request $request
     * @return Response
     *
     */

    public function hello(string $name ,Request $request):Response
    {
        $helloText = "czesc ".$name;
        $param1 = $request->get('param1', 'jakas wiadomosc');
        return new Response("<html lang='pl'><body><h1>$helloText</h1><p>$param1</p></body></html>");
    }

    /**
     * @Route(path="/redirect/{action}" ,requirements={"action"="hello|curentDate"} )
     * @param string $action
     * @return RedirectResponse
     * @throws \Exception
     */

    public function moveToAction(string $action):RedirectResponse
    {
        return $this->redirectToRoute($action, ['name'=>'some name']);
    }

    /**
     * @Route(path="/page/{autor}/{page}", requirements={"page"="\d+"})
     * @param int $page
     * @param string $autor
     * @return Response
     */

    public function page(int $page= 1,string $autor)
    {
        return new Response("witaj na stronie $page for $autor");
    }
}