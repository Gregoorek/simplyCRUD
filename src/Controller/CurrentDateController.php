<?php

namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

    class CurrentDateController
    {
        /**
         * @Route(path="/index",name="curentDate")
         * @return Response
         * @throws
         */
        public function curentDate() :Response
         {
            $currentDate = new \DateTime();
            $currentDateFormat = $currentDate->format(DATE_ATOM);
            $html = <<< EOT
            <html>
            <body>
                <h1>curent data</h1>
                <p>$currentDateFormat</p>
            </body>
            </html>
EOT;


            return new Response($html);


        }

    }