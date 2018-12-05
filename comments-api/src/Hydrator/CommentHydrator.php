<?php
namespace App\Hydrator;

use App\Entity\Comment;


class CommentHydrator
{
    /**
     * @param Comment $comment
     * @return array
     */
    public function extract(Comment $comment) : array
    {
        return [

            "id" => $comment->getId(),
            "entityUuid" => $comment->getEntityUuid(),
            "date" => $comment->getDate(),
            "username" => $comment->getUsername(),
            "message" => $comment->getMessage()

        ];
    }

    /**
     * @param Comment $comment
     * @param array $values
     * @return Comment
     */

    public function hydrate(Comment $comment, array $values = []) : Comment
    {
        foreach ($values as $key => $value)
        {
            $setterName = "set" . ucfirst($key);
            if(method_exists($comment, $setterName))
            {
                if ($setterName == "setDate") {
                    $comment->$setterName(new \DateTime($value));
                } else {
                    $comment->$setterName($value);
                }
            }
        }

        return $comment;
    }
}