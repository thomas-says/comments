<?php
/**
 * Created by PhpStorm.
 * User: grp6
 * Date: 26/11/2018
 * Time: 09:06
 */

namespace App\Gateway;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Gateway\CommentGatewayInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class CommentMySQLGateway
 *
 * @package App\Gateway
 */

class CommentMysqlGateway implements CommentGatewayInterface
{
    protected $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    public function findOneById(int $id): Comment
    {

        $repository = $this->getDoctrine()->getRepository(Comment::class);
        return $repository->find($id);

    }

    public function persist(Comment $comment): Comment
    {
        $this->getEntityManager()->persist($comment);
        $this->getEntityManager()->flush();
        return $comment;
    }
    public function delete(Comment $comment): Comment
    {
        // TODO: Implement delete() method.
        $this->getEntityManager()->remove($comment);
        $this->getEntityManager()->flush();
        return $comment;
    }

    public function findByEntityUuid(string $entity_uuid) : array
    {
        $repository = $this->getEntityManager()->getRepository(Comment::class);
        return $repository->findByEntityUuid($entity_uuid);
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }



}