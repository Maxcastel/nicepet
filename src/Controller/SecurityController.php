<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="app_security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/createUser", name="create_user")
     */
    public function create(Request $requete, HttpClientInterface $client)
    {
        $error = false;
        $messageError = 'Email ou mot de passe incorect';

        try {
            if ($requete->request->count() > 0) {

                $response = $client->request(
                    'POST',
                    'http://15.188.23.24:8642/api/v1/register',
                    [
                        'json' => [
                            'email' => $requete->request->get('email'),
                            'password' => $requete->request->get('password'),
                        ]
                    ]
                );

                if ($response->toArray()['status'] == 201) {
                    $session = $requete->getSession();
                    $session->set('token', $response->toArray()['data']['token']);
                    //$token = $session->get('token');

                    return $this->redirectToRoute('croquette');
                }
            }
        } catch (\Throwable $e) {
            dump($e->getResponse('Response'));
            if ($e->getCode() >= 400) {
                dd($e);
                $error = true;
                //$messageError = ;
            } 
        }

        return $this->render('security/createUser.html.twig', [
            'error' => $error,
            'messageError' => $messageError
        ]);
    }

    // public function signup(Request $requete, HttpClientInterface $client)
    // {
    //     if ($requete->request->count() > 0) {

    //         $client->request(
    //             'POST',
    //             'http://15.188.23.24:8642/api/v1/register',
    //             [
    //                 'json' => [
    //                     'email' => $requete->request->get('email'),
    //                     'password' => $requete->request->get('password'),
    //                 ]
    //             ]
    //         );
    //     }

    //     return $this->render('security/signup.html.twig');
    // }

    /**
     * @Route("/connexion", name="login")
     */
    public function login(Request $requete, HttpClientInterface $client)
    {
        // //$session->set('attribute-name', 'attribute-value');

        // $session = $requete->getSession();
        // $session->set('aa', 'test');

        // $foo = $session->get('foo');
        //var_dump($foo);
        //$request->headers->set($key, $value);

        $error = false;
        $messageError = 'Email ou mot de passe incorect';

        try {
            if ($requete->request->count() > 0) {

                $response = $client->request(
                    'POST',
                    'http://15.188.23.24:8642/api/v1/login',
                    [
                        'json' => [
                            'username' => $requete->request->get('email'),
                            'password' => $requete->request->get('password'),
                        ]
                    ]
                );

                if ($response->toArray()['status'] == 200) {
                    $session = $requete->getSession();
                    $session->set('token', $response->toArray()['data']['token']);
                    //$token = $session->get('token');

                    return $this->redirectToRoute('croquette');
                }
            }
        } catch (\Throwable $e) {

            if ($e->getCode() >= 400) {
                $error = true;
                $messageError = 'Email ou mot de passe incorect';
            } 
            dump('bb');
        }

        // dump($response->toArray());    
        // dump($response->toArray()['status']);
        // dump($response->toArray()['data']['token']);

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'messageError' => $messageError
        ]);
    }


    /**
     * @Route("/deconnexion", name="logout")
     */
    public function logout(Request $requete)
    {
        $session = $requete->getSession();
        
        $session->remove('token');

        $session->save();

        return $this->redirectToRoute('login');
    }
}

