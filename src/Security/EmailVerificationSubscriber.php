<?php

namespace App\Security;

use App\Entity\User;
use Proxies\__CG__\App\Entity\User as EntityUser;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;

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
			throw new CustomUserMessageAuthenticationException('Vous devez valider votre adresse mail pour pouvoir vous connecter. Vérifiez vos mails. <a href="/verify/resend">Renvoyer le mail de vérification</a>');
		}
	}

	public static function getSubscribedEvents()
	{
		return [
			CheckPassportEvent::class => ['onCheckPassport', -10],
		];
	}
}
