<?php

namespace projectAdmin\principalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use projectAdmin\loginBundle\Entity\Categoria;
use projectAdmin\loginBundle\Entity\Producto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends Controller {

    public function principalAction() {

        $session = $this->getRequest()->getSession();
        $idioma = $session->get('idioma');
        $em = $this->getDoctrine()->getManager();

        if ($idioma == 'ingles') {

            $idioma = 'ingles';





            // Lo mismo de abajo pero con ingles
        } else {



            $idioma = 'español';
        }


        $queryCategorias = $em->createQuery('SELECT u from projectAdminloginBundle:Categoria u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);

        $query = $em->createQuery('SELECT u from projectAdminloginBundle:Producto u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma)
                ->setMaxResults(6);



        $queryBanner = $em->createQuery('SELECT u from projectAdminloginBundle:Banner u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);
        $queryArticulos = $em->createQuery('SELECT u from projectAdminloginBundle:Articulo u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);
        $queryCaluga = $em->createQuery('SELECT u from projectAdminloginBundle:Caluga u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);
        $queryBannerAd = $em->createQuery('SELECT u from projectAdminloginBundle:Banner2 u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma)->setMaxResults(1);
        ;



        $categorias = $queryCategorias->getResult();
        $productos = $query->getResult();
        $banner = $queryBanner->getResult();
        $caluga = $queryCaluga->getResult();
        $banner2 = $queryBannerAd->getResult();
        $articulos = $queryArticulos->getResult();

        return $this->render('projectAdminprincipalBundle:Default:principal.html.twig', array('categoria' => $categorias, 'producto' => $productos, 'banner' => $banner,
                    'caluga' => $caluga, 'banner2' => $banner2, 'articulos' => $articulos, 'idioma' => $idioma));
    }

    public function vistaProductosAction($id) {
        $em = $this->getDoctrine()->getManager();

        $session = $this->getRequest()->getSession();
        $idioma = $session->get('idioma');

        if ($idioma == 'ingles') {

            $idioma = 'ingles';
        } else {


            $idioma = 'español';
        }

        $productos = $em->getRepository('projectAdminloginBundle:Producto')->findBy(array('categoria' => $id));
        $queryCategorias = $em->createQuery('SELECT u from projectAdminloginBundle:Categoria u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);
        $categoriaP = $em->getRepository('projectAdminloginBundle:Categoria')->findOneBy(array('id' => $id));
        $queryArticulos = $em->createQuery('SELECT u from projectAdminloginBundle:Articulo u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);
        $articulos = $queryArticulos->getResult();
        $categoria = $queryCategorias->getResult();
        return $this->render('projectAdminprincipalBundle:Default:productos.html.twig', array('productos' => $productos, 'categoria' => $categoria, 'categoriaP' => $categoriaP, 'articulos' => $articulos, 'idioma' => $idioma));
    }

    public function detalleProductoAction($id) {


        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $idioma = $session->get('idioma');


        if ($idioma == 'ingles') {

            $idioma = 'ingles';
        } else {


            $idioma = 'español';
        }


        $producto = $em->getRepository('projectAdminloginBundle:Producto')->findOneBy(array('id' => $id));
        $idCat = $producto->getCategoria()->getId();

        $productoAsoc = $em->getRepository('projectAdminloginBundle:Producto')->findBy(array('categoria' => $idCat));


        $queryCategorias = $em->createQuery('SELECT u from projectAdminloginBundle:Categoria u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);
        $queryArticulos = $em->createQuery('SELECT u from projectAdminloginBundle:Articulo u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);

        $categorias = $queryCategorias->getResult();
        $articulos = $queryArticulos->getResult();





        return $this->render('projectAdminprincipalBundle:Default:productoDetalle.html.twig', 
                    array('categoria' => $categorias, 'producto' => $producto,
                    'productoAsoc' => $productoAsoc, 'articulos' => $articulos , 'idioma' => $idioma));
        
    }

    public function formularioContactoAction() {
        $em = $this->getDoctrine()->getManager();
        
        
        $session = $this->getRequest()->getSession();
        $idioma = $session->get('idioma');


        if ($idioma == 'ingles') {

            $idioma = 'ingles';
        } else {


            $idioma = 'español';
        }

        
        
        
        $queryCategorias = $em->createQuery('SELECT u from projectAdminloginBundle:Categoria u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);
    
        $queryArticulos = $em->createQuery('SELECT u from projectAdminloginBundle:Articulo u WHERE u.idioma=:idioma order by u.id desc ')
                ->setParameter('idioma', $idioma);
        
        $categorias = $queryCategorias->getResult();
        
        $articulos = $queryArticulos->getResult();
        
        
        return $this->render('projectAdminprincipalBundle:Default:formularioContacto.html.twig', array('categoria' => $categorias, 'articulos' => $articulos , 'idioma' => $idioma ));
        
        
        
        
    }

    public function vistaArticuloAction() {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('projectAdminloginBundle:Categoria')->findAll();
        return $this->render('projectAdminprincipalBundle:Default:Articulo.html.twig', array('categoria' => $categorias));
    }

    public function functionDetalleCalugaAction($id) {


        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $idioma = $session->get('idioma');



        if ($idioma == 'ingles') {

            $idioma = 'ingles';
        } else {


            $idioma = 'español';
        }

        $queryArticulos = $em->createQuery('SELECT u from projectAdminloginBundle:Articulo u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);
        $queryCategorias = $em->createQuery('SELECT u from projectAdminloginBundle:Categoria u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);


        $articulos = $queryArticulos->getResult();
        $categorias = $queryCategorias->getResult();
        $caluga = $em->getRepository('projectAdminloginBundle:Caluga')->findOneBy(array('id' => $id));

        return $this->render('projectAdminprincipalBundle:Default:articuloCaluga.html.twig', array('caluga' => $caluga, 'categoria' => $categorias, 'articulos' => $articulos, 'idioma' => $idioma));
    }

    public function sendContactoAction(Request $request) {

        $nombre = $request->request->get('nombre');
        $email = $request->request->get('email');
        $mesanje = $request->request->get('mensaje');


        if ($nombre == '' or $email == '' or $mesanje == '') {


            return new Response('100');
            
            
        } else {

            $message = \Swift_Message::newInstance()
                    ->setSubject('Contacto')
                    ->setFrom('giorgosbarkos@gmail.com')
                    ->setTo('giorgosbarkos@gmail.com')
                    ->setBody(
                    $this->renderView(
                            'projectAdminprincipalBundle:Default:contacto.html.twig', array('nombre' => $nombre, 'email' => $email, 'mensaje' => $mesanje)
                    )
                    )
            ;
            $this->get('mailer')->send($message);

            return new Response('200');
        }
    }

    public function cargarArticuloAction($id) {


        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $idioma = $session->get('idioma');



        if ($idioma == 'ingles') {

            $idioma = 'ingles';
        } else {


            $idioma = 'español';
        }


        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('projectAdminloginBundle:Articulo')->findOneBy(array('id' => $id));
        $queryArticulos = $em->createQuery('SELECT u from projectAdminloginBundle:Articulo u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);
        $queryCategorias = $em->createQuery('SELECT u from projectAdminloginBundle:Categoria u WHERE u.idioma=:idioma order by u.id desc ')->setParameter('idioma', $idioma);
        $articulos = $queryArticulos->getResult();
        $categorias = $queryCategorias->getResult();

        return $this->render('projectAdminprincipalBundle:Default:Articulo.html.twig', array('articulo' => $articulo, 'categoria' => $categorias, 'articulos' => $articulos, 'idioma' => $idioma));
    }

    public function IdiomasAction() {

        $em = $this->getDoctrine()->getManager();
        return new Response('100');
    }

    public function ingles2Action() {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->set('idioma', 'ingles');

        return $this->redirect('../home');
    }

    public function espanolAction() {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->set('idioma', 'español');


        return $this->redirect('../home');
    }

}