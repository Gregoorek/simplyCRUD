<?php

namespace App\Controller;

use App\Service\LuckyNumber;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class helloController extends AbstractController
{
    /**
     * @Route(path="/hi/{name}", name="hello")
     * @param string $name
     * @param Request $request
     * @param LoggerInterface $logger
     * @param LuckyNumber $number
     * @return Response
     *
     */

    public function hello(string $name ,Request $request, LoggerInterface $logger, LuckyNumber $luckyNumber ):Response
    {

        $number = $luckyNumber->getNumber();
        $personName = ['tomek','ania','monika'];
        $logger->debug("powitany ". $name);
        return $this ->render( 'hello/hi.html.twig',['number'=>$number,'name'=>$name, 'personName' => $personName,'show'=>true]);
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