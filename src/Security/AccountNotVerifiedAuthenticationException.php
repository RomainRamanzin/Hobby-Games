<?php

namespace App\Security;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AccountNotVerifiedAuthenticationException extends AuthenticationException
{
     public function getMessageKey(): string
     {
          return 'Vous devez vérifier votre adresse email afin de pouvoir vous connecter.';
     }
}
