<?php
namespace App\Gateway;

use App\Entity\Comment;

/**
 * Class CommentGatewayInterface
 *
 * @package App\Gateway
 */

interface CommentGatewayInterface
{
    public function persist(Comment $comment): Comment;
    public function delete(Comment $comment): Comment;

    public function findOneById(int $id): Comment;
    public function findByEntityUuid(String $entity_uuid) : array;
}