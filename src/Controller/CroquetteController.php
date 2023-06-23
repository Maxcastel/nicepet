<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AddCroquetteType;

class CroquetteController extends AbstractController
{
    //15.188.23.24:8742/api/v1/croquette
    //racine de api_dev : 15.188.23.24:8742/api/v1/croquette

    /**
     * @Route("/croquette", name="croquette")
     */
    public function index(Request $requete, HttpClientInterface $client): Response
    {
        $session = $requete->getSession();

        $croquettes = $client->request(
            'GET',
            'http://15.188.23.24:8642/api/v1/croquette',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                ],
            ]
        );
        //return new JsonResponse($croquettes->toArray(),200);
        dump($croquettes->toArray()['data']);

        return $this->render('croquette/croquettes.html.twig', [
            'croquettes' => $croquettes->toArray()['data']
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('croquette/home.html.twig', [
            'title' => 'NicePet'
        ]);
    }

    /**
     * @Route("/croquette/show/{id}", name="croquette_show")
     */
    public function show(Request $requete, $id, HttpClientInterface $client): Response
    {
        $session = $requete->getSession();

        $croquette = $client->request(
            'GET',
            'http://15.188.23.24:8642/api/v1/croquette/' . $id,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                ],
            ]
        );
        dump($croquette->toArray()['data']);

        return $this->render('croquette/show.html.twig', [
            'croquette' => $croquette->toArray()['data'],
            'id' => $id
        ]);
    }

    /**
     * @Route("/croquette/new", name="croquette_new")
     */
    public function create(Request $requete, HttpClientInterface $client): Response
    {
        $session = $requete->getSession();

        if ($requete->request->count() > 0) {
            $croquettes = $client->request(
                'POST',
                'http://15.188.23.24:8642/api/v1/croquette',
                [
                    'json' => [
                        'name' => $requete->request->get('name'),
                        'url' => $requete->request->get('url'),
                        'urlimage' => $requete->request->get('url-image'),
                        'validate' => 'true',
                        'sterilise' => 'true',
                        'productId' => '123',
                        'brand' => [
                            'name' => $requete->request->get('brand')
                        ],
                        'categories' => [
                            [
                                'typePet' => $requete->request->get('category')
                            ]
                        ],
                        'characteristic' => [
                            'cendres' => $requete->request->get('cendres'),
                            'eau' => $requete->request->get('eau'),
                            'fibre' => $requete->request->get('fibre'),
                            'glucide' => $requete->request->get('glucide'),
                            'lipide' => $requete->request->get('lipide'),
                            'proteine' => $requete->request->get('proteine')
                        ]

                    ],
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                    ]
                ]
            );
            //dd($croquettes);
            // dd($croquettes->toArray());
        }

        return $this->render('croquette/create.html.twig');
    }

    /**
     * @Route("/croquette/edit/{id}", name="croquette_edit")
     */
    public function edit($id, HttpClientInterface $client, Request $requete): Response
    {
        $session = $requete->getSession();

        $croquette = $client->request(
            'GET',
            'http://15.188.23.24:8642/api/v1/croquette/' . $id,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                ],
            ]
        );
        dump($croquette->toArray()['data']);

        if ($requete->request->count() > 0) {
            $response = $client->request(
                'PUT',
                'http://15.188.23.24:8642/api/v1/croquette/' . $id,
                [
                    'json' => [
                        'name' => $requete->request->get('name'),
                        'url' => $requete->request->get('url'),
                        'urlimage' => $requete->request->get('url-image'),
                        'validate' => 'true',
                        'sterilise' => 'true',
                        'productId' => '123',
                        'brand' => [
                            'name' => $requete->request->get('brand')
                        ],
                        'categories' => [
                            [
                                'typePet' => $requete->request->get('category')
                            ]
                        ],
                        'characteristic' => [
                            'cendres' => $requete->request->get('cendres'),
                            'eau' => $requete->request->get('eau'),
                            'fibre' => $requete->request->get('fibre'),
                            'glucide' => $requete->request->get('glucide'),
                            'lipide' => $requete->request->get('lipide'),
                            'proteine' => $requete->request->get('proteine')
                        ]

                    ]
                ]
            );
        }

        return $this->render('croquette/edit.html.twig', [
            'croquette' => $croquette->toArray()['data'],
            'id' => $id
        ]);
    }

    /**
     * @Route("/croquette/delete/{id}", name="croquette_deletebyid")
     */
    public function deleteById($id, HttpClientInterface $client, Request $requete): Response
    {
        $session = $requete->getSession();

        $response = $client->request(
            'DELETE',
            'http://15.188.23.24:8642/api/v1/croquette/'.$id,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                ],
            ]
        );

        // return $this->render('croquette/croquette.html.twig', [
        //     //'croquette' => $croquette->toArray()['data'],
        //     'id' => $id
        // ]);

        return $this->redirectToRoute('croquette');
    }
}
