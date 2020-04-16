<?php
/**
 * Chat controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ChatController.
 *
 * @Route("/chatController")
 */
class ChatController extends AbstractController
{
    /**
     * Index action.
     *
     * @param int|null $roomId User input
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{roomId}",
     *     methods={"GET"},
     *     name="chatControllerIndex",
     *     defaults={"roomId":"0"},
     *     requirements={"roomId": "[0-9]+"},
     * )
     */
    public function Index(int $roomId): Response
    {
        return $this->render(
            'chatController/index.html.twig',
            ['roomId' => $roomId]
        );
    }

    /**
     * Add Entry action.
     *
     * @return \Symfony\Component\HttpFoundation\Request HTTP response
     *
     * @Route(
     *     "/AddEntry",
     *     methods={"POST"},
     *     name="chatControllerAddEntry",
     * )
     */
    public function AddEntry(Request $request): Response
    {
        echo  "Received " . $request->getMethod();
        echo  "Data " . $request->get("lname") . " " . $request->get("fname");

        return $this->render(
            'chatController/index.html.twig',
            ['roomId' => 1] // 1 set for testing.
        );
    }
}

