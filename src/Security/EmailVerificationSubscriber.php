<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class EmailVerificationSubscriber implements EventSubscriberInterface
{
	public function onCheckPassport(CheckPassportEvent $event)
	{
		$passport = $event->getPassport();
		if (!$passport instanceof Passport) {
			throw new \Exception('Unexpected passport type');
		}
		$user = $passport->getUser();
		if (!$user instanceof User) {
			throw new \Exception('Unexpected user type');
		}

		if (!$user->isVerified()) {
			throw new AccountNotVerifiedAuthenticationException('Votre adresse email doit être vérifiée.');
		}
	}

	public static function getSubscribedEvents()
	{
		return [
			CheckPassportEvent::class => ['onCheckPassport', -10],
		];
	}
}
