<?php
namespace App\Manager;

use App\Gateway\CommentMysqlGateway;
use App\Gateway\CommentGatewayInterface;
use App\Entity\Comment;


/**
 * Class CommentManager
 *
 * @package App\Manager
 */

class CommentManager
{
    /** @var CommentGatewayInterface */
    protected $gateway;

    public function __construct(CommentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function findOneById(int $id): Comment
    {
        return $this->getGateway()->findOneById($id);
    }

    public function persist(Comment $comment): Comment
    {
        return $this->getGateway()->persist($comment);
    }

    public function delete(Comment $comment): Comment
    {
        return $this->getGateway()->delete($comment);
    }
    public function findByEntityUuid(String $entity_uuid) : array
    {
        return $this->getGateway()->findByEntityUuid($entity_uuid);
    }


    /**
     * @return CommentGatewayInterface
     */
    public function getGateway(): CommentGatewayInterface
    {
        return $this->gateway;
    }
}