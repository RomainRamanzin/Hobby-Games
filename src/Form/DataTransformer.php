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
        if (null === $game) {
            return 0;
        }

        return $game->getId();
    }

    public function reverseTransform($gameId): ?Game
    {
        if (!$gameId) {
            return null;
        }

        $game = $this->entityManager->getRepository(Game::class)->find($gameId);

        if (null === $game) {
            throw new TransformationFailedException(sprintf('The game with id "%s" does not exist!', $gameId));
        }

        return $game;
    }
}
