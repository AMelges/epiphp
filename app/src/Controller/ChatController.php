<?php
/**
 * Chat controller.
 */

namespace App\Controller;

use App\ChatroomData;
use App\ChatroomEntryData;
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
        session_start();

        // TODO: Wrap to function check if room exits.
        $currentChatroomData = null;

        if(!isset($_SESSION['chatroomsData']))
        {
            echo "Recreated chatrooms.";
            $_SESSION['chatroomsData'] = array();
        }

        foreach ($_SESSION['chatroomsData'] as $chatroomData)
        {
            echo "Iterating over:" . var_dump($chatroomData) . "<br>";
            if ($chatroomData->roomId == $roomId) {
                $currentChatroomData = $chatroomData;
                echo "Found chatroom:" . var_dump($currentChatroomData) . "<br>";
                break;
            }
        }

        if (is_null($currentChatroomData))
        {
            $currentChatroomData = new ChatroomData($roomId, array());
            array_push($_SESSION['chatroomsData'], $currentChatroomData);
        }

        return $this->render(
            'chatController/index.html.twig',
            ['roomId' => $roomId, 'content'=>$currentChatroomData->content]
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
        $roomId = $request->get("roomId");
        $userId =  $request->get("userId") ;
        $content = $request->get("content");

        // TODO: Wrap to function check if room exits.
        $currentChatroomData = null;

        if(!isset($_SESSION['chatroomsData'])) {
            echo "Recreated chatrooms.";
            $_SESSION['chatroomsData'] = array();
        }

        foreach ($_SESSION['chatroomsData'] as $chatroomData)
        {
            echo "Iterating over:" . var_dump($chatroomData) . "<br>";
            if ($chatroomData->roomId == $roomId) {
                $currentChatroomData = $chatroomData;
                echo "Found chatroom:" . var_dump($currentChatroomData) . "<br>";
                break;
            }
        }

        if (is_null($currentChatroomData))
        {
            $currentChatroomData = new ChatroomData($roomId, array());
            array_push($_SESSION['chatroomsData'], $currentChatroomData);
        }

        // Add new entry to current ChatRoom.
        $newContent = new ChatroomEntryData($userId, $content);
        array_push($currentChatroomData->content, $newContent);

        return $this->render(
            'chatController/index.html.twig',
            ['roomId' => $roomId, 'content' => $currentChatroomData->content]
        );
    }

    // Teoretycznie: zamienić repozytorium w kolejkę SQS, teoretycznie.
}

