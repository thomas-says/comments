<?php

namespace App\Controller;

use App\Manager\CommentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Hydrator\CommentHydrator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Comment;
use Symfony\Component\Routing\Annotation\Route;

class PersistCommentController extends AbstractController
{
    /**
     * @Route(path="/persist/comment",methods={"POST"} , name="persist_comment")
     */

        public function __invoke(Request $request, CommentManager $commentManager, CommentHydrator $commentHydrator)
    {
        $comment = $commentHydrator->hydrate(new Comment(), $request->request->all());
        if ($comment->getId() !== null) {
            $comment = $commentManager->findOneById($comment->getId());
            $comment = $commentHydrator->hydrate($comment, $request->request->all());
        }

        $comment = $commentManager->persist($comment);

        return new JsonResponse($commentHydrator->extract($comment));

    }
}
