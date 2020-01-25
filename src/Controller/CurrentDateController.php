<?php

namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

    class CurrentDateController
    {
        /**
         * @Route(path="/index",name="curentDate", methods={"POST"})
         * @return Response
         * @throws
         */
        public function curentDate() :Response
         {
            $currentDate = new \DateTime();
            return $this->getDataResponse('current date ',$currentDate);
        }


        /**
         * @Route(path="/index", methods={"GET"})
         * @return Response
         * @throws \Exception
         */
        public function tommorowDate(): Response
        {
            $tommorow = new \DateTime();
            $tommorow->add(new \DateInterval('P1D'));
            return  $this->getDataResponse('tommorow date',$tommorow);
        }

        private function getDataResponse(string $title , \DateTime $dateTime)
        {
            $format = $dateTime->format(DATE_ATOM);
             $html = <<< EOT
            <html lang="pl">
            <body>
                <h1>$title</h1>
                <p>$format</p>
            </body>
            </html>
EOT;
            return new Response($html);
        }
    }