<?php
/**
 * Main controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController.
 *
 * @Route("/mainController")
 */
class MainController extends AbstractController
{
    /**
     * Index action.
     *
     * @param string|null $name User input
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{userName}",
     *     methods={"GET"},
     *     name="mainControllerIndex",
     *     defaults={"userName":"stranger"},
     *     requirements={"userName": "[a-zA-Z]+"},
     * )
     */
    public function Index(string $userName): Response
    {
        return $this->render(
            'mainController/index.html.twig',
            ['userName' => $userName]
        );
    }
}