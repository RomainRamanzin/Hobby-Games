<?php

namespace App\Form\DataTransformer;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class GameTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($game): int
    {
        // $game is either null or an object (Game)
        if (null === $game) {
            return 0;
        }

        return $game->getId();
    }

    // transforms the string (id) back to an object (Game)
    public function reverseTransform($gameId): ?Game
    {
        if (!$gameId) {
            return null;
        }

        // no Game object found by id
        $game = $this->entityManager->getRepository(Game::class)->find($gameId);

        // cause a validation error
        if (null === $game) {
            throw new TransformationFailedException(sprintf('The game with id "%s" does not exist!', $gameId));
        }

        return $game;
    }
}
