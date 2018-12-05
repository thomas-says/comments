<?php
/**
 * Created by PhpStorm.
 * User: louis
 * Date: 05/12/2018
 * Time: 10:50
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Hydrator\CommentHydrator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Manager\CommentManager;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;


class GetCommentController
{

    /**
     * @Route(path="/get/comment/{Uuid} ", methods={"GET"}, name="get_comment")
     */
    public function __invoke(Request $request, CommentManager $commentManager, CommentHydrator $commentHydrator, String $Uuid)
    {
        $data = $commentManager->findByEntityUuid($Uuid);
        $data = array_map([$commentHydrator,'extract'], $data);



        return new JsonResponse($data);
    }
}