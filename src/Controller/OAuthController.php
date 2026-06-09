<?php

namespace App\Controller;

use App\Repository\TokenRepository;
use App\Service\ArubaBusinessClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/oauth')]
class OAuthController extends AbstractController
{
    public function __construct(
        private readonly ArubaBusinessClient $arubaClient,
        private readonly TokenRepository $tokenRepository
    ) {}

    #[Route('/authorize', name: 'oauth_authorize', methods: ['GET'])]
    public function authorize(Request $request): Response
    {
        $redirectUri = $request->query->get('redirect_uri');
        $state       = $request->query->get('state');

        return $this->render('auth/login.html.twig', [
            'redirect_uri' => $redirectUri,
            'state'        => $state,
            'error'        => null,
        ]);
    }

    #[Route('/aruba-login', name: 'oauth_aruba_login', methods: ['POST'])]
    public function arubaLogin(Request $request): Response
    {
        $username    = $request->request->get('username');
        $password    = $request->request->get('password');
        $otp         = $request->request->get('otp');
        $redirectUri = $request->request->get('redirect_uri');
        $state       = $request->request->get('state');

        try {
            $tokens = $this->arubaClient->authenticateWith($username, $password, $otp);
            
            $code = bin2hex(random_bytes(16));
            $this->tokenRepository->saveCode($code, $tokens);

            $sep = str_contains($redirectUri, '?') ? '&' : '?';
            $target = $redirectUri . $sep . 'code=' . $code . '&state=' . $state;

            return $this->redirect($target);

        } catch (\Throwable $e) {
            return $this->render('auth/login.html.twig', [
                'redirect_uri' => $redirectUri,
                'state'        => $state,
                'error'        => 'Login Aruba fallito: ' . $e->getMessage(),
            ]);
        }
    }

    #[Route('/token', name: 'oauth_token', methods: ['POST'])]
    public function token(Request $request): Response
    {
        $code = $request->request->get('code');
        
        $codeData = $this->tokenRepository->getCode($code);
        if (!$codeData) {
            return $this->json(['error' => 'invalid_grant'], 400);
        }

        $mcpToken = bin2hex(random_bytes(32));
        
        $this->tokenRepository->saveTokens($mcpToken, [
            'aruba_access_token'  => $codeData['aruba_access_token'],
            'aruba_refresh_token' => $codeData['aruba_refresh_token'],
            'aruba_expires_at'    => $codeData['aruba_expires_at'],
        ]);

        return $this->json([
            'access_token' => $mcpToken,
            'token_type'   => 'Bearer',
            'expires_in'   => 3600,
        ]);
    }
}
