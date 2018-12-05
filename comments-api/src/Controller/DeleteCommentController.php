<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Hydrator\CommentHydrator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Manager\CommentManager;
use App\Entity\Comment;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCommentController extends AbstractController
{
    /**
     * @Route(path="/delete/comment/{id} ", methods={"DELETE"}, name="delete_comment")
     */
    public function __invoke(Request $request, CommentManager $commentManager, CommentHydrator $commentHydrator, int $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $comment = $em->getRepository(Comment::class)->find($id);

        $em->remove($comment);
        $em->flush();

        return new JsonResponse($commentHydrator->extract($comment));
    }
}
