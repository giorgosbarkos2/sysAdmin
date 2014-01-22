<?php

namespace projectAdmin\loginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use projectAdmin\loginBundle\Entity\Categoria;
use projectAdmin\loginBundle\Entity\Caluga;
use projectAdmin\loginBundle\Entity\Usuario;
use projectAdmin\loginBundle\Entity\Banner;
use projectAdmin\loginBundle\Entity\Banner2;
use projectAdmin\loginBundle\Entity\Producto;
use projectAdmin\loginBundle\Entity\Foto;
use projectAdmin\loginBundle\Entity\Articulo;
use projectAdmin\loginBundle\Entity\FotoCaluga;



class DefaultController extends Controller {

    public function vistaloginAction() {
        return $this->render('projectAdminloginBundle:Default:index.html.twig');
    }
    
    
    
    
    public function vistaUploadCalugaAction(){
        
               return $this->render('projectAdminloginBundle:Default:uploadCaluga.html.twig');
    }
    
    
    public function uploadCalugaAction(){
        
        
        
           $session = $this->getRequest()->getSession();
        $id = $session->get('calugaId');
        
        
        $idProducto = $id;
        
        
        $fileName = ($_REQUEST["name"]);
        
        $targetDirectorio = 'caluga/' . $idProducto . '/' . $fileName;
        if (file_exists($targetDirectorio)) {
        } else {
            //   mkdir('fotos/', 0777, true);
        }



        $targetDir = 'caluga/' . $idProducto . '/';

        //$targetDir = 'uploads';

        $cleanupTargetDir = true; 
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        @set_time_limit(5 * 60);


        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';


        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


        if (!file_exists($targetDir))
            @mkdir($targetDir);


        if ($cleanupTargetDir) {
            if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
        }

        $uno = 'uno';
        
        
        
          
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];


        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {

                    $in = @fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    }
                    else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    @fclose($in);
                    @fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = @fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                @fclose($in);
                @fclose($out);
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);

            $em = $this->getDoctrine()->getManager();
            $caluga = $em->getRepository('projectAdminloginBundle:Caluga')->findOneBy(array('id' => $id));
            
           
           $em->persist($caluga);
           $fotoCaluga = new FotoCaluga();
           $fotoCaluga->setUrl($fileName);
           $fotoCaluga->setCaluga($caluga);
           $em->flush();
           
           
           $em->persist($fotoCaluga);
           $em->persist($caluga);
           $em->flush();
           
           
    
            
            
            
        }
        
          return new Response($fileName);
          
          
          
        
        
    }
    
    public function uploadBannerAction(){
        
        
         $session = $this->getRequest()->getSession();
        $id = $session->get('idBanner');
        
        $idProducto = $id;
        
        $fileName = ($_REQUEST["name"]);
        
        $targetDirectorio = 'banner/' . $idProducto . '/' . $fileName;
        if (file_exists($targetDirectorio)) {
        } else {
            //   mkdir('fotos/', 0777, true);
        }



        $targetDir = 'banner/' . $idProducto . '/';

        //$targetDir = 'uploads';

        $cleanupTargetDir = true; 
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        @set_time_limit(5 * 60);


        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';


        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


        if (!file_exists($targetDir))
            @mkdir($targetDir);


        if ($cleanupTargetDir) {
            if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
        }

        $uno = 'uno';
        
        
        
          
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];


        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {

                    $in = @fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    }
                    else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    @fclose($in);
                    @fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = @fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                @fclose($in);
                @fclose($out);
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);

            $em = $this->getDoctrine()->getManager();
            $banner = $em->getRepository('projectAdminloginBundle:Banner')->findOneBy(array('id' => $id));
       
           $em->persist($banner);
           $em->flush();
           
           $banner->setLink($fileName);
           $em->persist($banner);
           $em->flush();
           
    
            
            
            
        }
        
          return new Response($fileName);
    }
    
    
    public function uploadProductosImgAction() {
        
        $session = $this->getRequest()->getSession();
        $id = $session->get('idProducto');
        $idProducto = $id;
        
        $fileName = ($_REQUEST["name"]);
        
        $targetDirectorio = 'productos/' . $idProducto . '/' . $fileName;
        if (file_exists($targetDirectorio)) {
        } else {
            //   mkdir('fotos/', 0777, true);
        }



        $targetDir = 'productos/' . $idProducto . '/';

        //$targetDir = 'uploads';

        $cleanupTargetDir = true; 
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        @set_time_limit(5 * 60);


        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';


        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


        if (!file_exists($targetDir))
            @mkdir($targetDir);


        if ($cleanupTargetDir) {
            if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
        }

        $uno = 'uno';
        
        
        
          
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];


        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {

                    $in = @fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    }
                    else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    @fclose($in);
                    @fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = @fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                @fclose($in);
                @fclose($out);
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);

            $em = $this->getDoctrine()->getManager();
            $productos = $em->getRepository('projectAdminloginBundle:Producto')->findOneBy(array('id' => $id));
       


            $foto = new Foto();

            $foto->setEstado('activo');
           
       
            $foto->setFecha(new \DateTime());
            $foto->setProducto($productos);
           
           
            $foto->setUrl($fileName);
            $em->persist($productos);
            $em->persist($foto);
            $em->flush();
            
            
            
            
           
        }

        return new Response($fileName);
    }

    public function loginVistaAction() {



        return $this->render('projectAdminloginBundle:Default:login.html.twig');
    }

    public function principalVistaAction() {

        $session = $this->getRequest()->getSession();

        $nombre = $session->get('nusuario');
        $contrasena = $session->get('contrasena');
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('projectAdminloginBundle:Usuario')->findOneBy(array('nusuario' => $nombre, 'contrasena' => $contrasena));

        if ($admin) {

            return $this->render('projectAdminloginBundle:Default:principal.html.twig');
        } else {
            return new Response('No autorizado');
        }
    }

    public function recibeloginAction(Request $data) {
        $nombre = $data->request->get('nusuario');


        $contrasena = $data->request->get('contrasena');
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();



        $admin = $em->getRepository('projectAdminloginBundle:Usuario')->findOneBy(array('nusuario' => $nombre, 'contrasena' => $contrasena));

        if ($admin) {
            $response = '200';
            $session->set('nusuario', $nombre);
            $session->set('contrasena', $contrasena);

            return new Response($response);
        } else {
            $response = '100';

            return new Response($response);
        }
    }

    function vistaFormularioCategoriaAction() {
        $mensaje = '';
        return $this->render('projectAdminloginBundle:Default:formularioCategoria.html.twig' , array('mensaje' , $mensaje));
    }

    function guardarCategoriaAction(Request $data) {

        $nombre = $data->request->get('nombre');
        $idioma = $data->request->get('idioma');
        $descripcioncorta = $data->request->get('descripcioncorta');
        $descripcion = $data->request->get('descripcion');

        $em = $this->getDoctrine()->getManager();
        $categoria = new Categoria();

        $categoria->setNombre($nombre);
        $categoria->setIdioma($idioma);
        $categoria->setDescripcioncorta($descripcioncorta);
        $categoria->setDescripcion($descripcion);

        $em->persist($categoria);
        $em->flush();
        
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->findAll();
        $mensaje = 'Categoría guardada';
        return $this->render('projectAdminloginBundle:Default:listarCategoria.html.twig' , array('mensaje' => $mensaje ,
          'categoria' =>   $categoria ));
    
    }

    public function listarCategoriaAction() {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->findAll();
        $mensaje = '';
        return $this->render('projectAdminloginBundle:Default:listarCategoria.html.twig', array('categoria' => $categoria , 'mensaje' => $mensaje));
    }

    public function editarCategoriaAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->find($id);
        return $this->render('projectAdminloginBundle:Default:editarCategoria.html.twig', array('categoria' => $categoria));
    }

    public function guardarEditarCategoriaAction(Request $data) {

        $id = $data->request->get('id');
        $nombre = $data->request->get('nombre');
        $idioma = $data->request->get('idioma');
        $descripcioncorta = $data->request->get('descripcioncorta');
        $descripcion = $data->request->get('descripcion');
     

        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->findOneBy(array('id' => $id));
        
        $categoria->setNombre($nombre);
        $categoria->setIdioma($idioma);
        $categoria->setDescripcioncorta($descripcioncorta);
        $categoria->setDescripcion($descripcion);
       

        $em->persist($categoria);
        $em->flush();
         
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->findAll();
        
         $mensaje = 'Cambios Guardados ';
        return $this->render('projectAdminloginBundle:Default:listarCategoria.html.twig' , array('mensaje' => $mensaje ,
          'categoria' =>   $categoria ));

    }

    public function eliminarCategoriaAction(Request $request) {
       $id =  $request->request->get('recordToDelete');
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->find($id);
        $em->remove($categoria);
        $em->flush();
        return new Response('Categoria Eliminada');
    }

    public function vistaFormularioProductoAction() {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('projectAdminloginBundle:Categoria')->findAll();
        return $this->render('projectAdminloginBundle:Default:formularioProductos.html.twig', array('categorias' => $categorias));
    }
    

    public function guardarProductoAction(Request $data) {
        
        $session = $this->getRequest()->getSession();
        
        $nombre = $data->request->get('nombre');
        $idioma = $data->request->get('idioma');
        $codigo = $data->request->get('codigo');
        $talla = $data->request->get('talla');
        $categoriaid = $data->request->get('categoria');
        $caracteristicauno = $data->request->get('caracteristicauno');
        $caracteristicados = $data->request->get('caracteristicados');
        $caracteristicatres = $data->request->get('caracteristicatres');
        $estado = $data->request->get('estado');
        $stock = $data->request->get('stock');
        $descripcioncorta = $data->request->get('descripcioncorta');
        $descripcion = $data->request->get('descripcion');
         
        
        
        $em = $this->getDoctrine()->getManager();
        $categoria  =$em->getRepository('projectAdminloginBundle:Categoria')->findOneBy(array('id' =>$categoriaid) );
              
        $producto = new Producto();

        $producto->setNombre($nombre);
        $producto->setIdioma($idioma);
        $producto->setCodigo($codigo);
        $producto->setTalla($talla);
        $producto->setCaracteristicasuno($caracteristicauno);
        $producto->setCaracteristicasdos($caracteristicados);
        $producto->setCaracteristicastres($caracteristicatres);
        $producto->setEstado($estado);
        $producto->setStock($stock);
        $producto->setDescripcioncorta($descripcioncorta);
        $producto->setDescripcion($descripcion);
        $producto->setCategoria($categoria);
        

        $em->persist($producto);
        $em->flush();
        
        $idProducto = $producto->getId();
        $session->set('idProducto', $idProducto);
        
        
        $session->set('mensaje Producto');
        
        return $this->redirect('uploadImagen');
    }

    public function listarProductoAction() {
        $em = $this->getDoctrine()->getManager();
        $prodcuto = $em->getRepository('projectAdminloginBundle:Producto')->findAll();
        return $this->render('projectAdminloginBundle:Default:listarProductos.html.twig', array('producto' => $prodcuto));
    }
    
    public function vistaFormularioEditarProductoAction($id) {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->set('idProducto' , $id);
        $producto = $em->getRepository('projectAdminloginBundle:Producto')->find($id);
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->findAll();
        return $this->render('projectAdminloginBundle:Default:editarProducto.html.twig', array('producto'=>$producto, 'categoria'=> $categoria));
    }

    public function guardarEditarProductoAction(Request $data) {
        
        $id = $data->request->get('id');
        $nombre = $data->request->get('nombre');
        $idioma = $data->request->get('idioma');
        $codigo = $data->request->get('codigo');
        $talla = $data->request->get('talla');
        $categoriaid = $data->request->get('categoria');
        $caracteristicauno = $data->request->get('caracteristicauno');
        $caracteristicados = $data->request->get('caracteristicados');
        $caracteristicatres = $data->request->get('caracteristicatres');
        $estado = $data->request->get('estado');
        $stock = $data->request->get('stock');
        $descripcioncorta = $data->request->get('descripcioncorta');
        $descripcion = $data->request->get('descripcion'); 

        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('projectAdminloginBundle:Producto')->findOneBy(array('id' => $id));
        $categoria = $em->getRepository('projectAdminloginBundle:Categoria')->findOneBy(array('id' => $categoriaid));
        
        
        $producto->setNombre($nombre);
        $producto->setIdioma($idioma);
        $producto->setCodigo($codigo);
        $producto->setTalla($talla);
        $producto->setCaracteristicasuno($caracteristicauno);
        $producto->setCaracteristicasdos($caracteristicados);
        $producto->setCaracteristicastres($caracteristicatres);
        $producto->setEstado($estado);
        $producto->setStock($stock);
        $producto->setDescripcioncorta($descripcioncorta);
        $producto->setDescripcion($descripcion);
        $producto->setCategoria($categoria);
        
        $em->persist($producto);
        $em->persist($categoria);
        $em->flush($categoria);
        
        
        return $this->redirect('listarProducto');
    }
    
    public function eliminarProductoAction(Request $request) {
        
        
        $id = $request->request->get('recordToDelete');
        $em = $this->getDoctrine()->getManager(); 
        $producto = $em->getRepository('projectAdminloginBundle:Producto')->find($id);
        $em->remove($producto);
        $em->flush();
        return new Response('Producto Eliminado');
        
        
        
    }
    
    public function vistaFormularioFotoBannerAction(){
        return $this->render('projectAdminloginBundle:Default:formularioFotoBanner.html.twig');
    }
    
    public function guardarFormularioBannerAction(Request $data) {
        
        $nombre = $data->request->get('nombre');
        $titulo  = $data->request->get('titulo');
        $estado = $data->request->get('estado');
        $url = $data->request->get('url');
        $piedefoto = $data->request->get('piedefoto');
        $idioma = $data->request->get('idioma');
        
        $em = $this->getDoctrine()->getManager();
        $banner =  new Banner();
        
        $banner->setNombre($nombre);
        $banner->setTitulo($titulo);
        $banner->setEstado($estado);
        $banner->setPiedefoto($piedefoto);
        $banner->setUrl($url);
        $banner->setIdioma($idioma);
  
        $banner->setFecha(new \DateTime());
        
        $em->persist($banner);
        $em->flush();
        $id = $banner->getId();
        $session = $this->getRequest()->getSession();
        $session->set('idBanner', $id);
        
        
        
    
        return $this->redirect('uploadBannerView');
        
    }
    
    public function listarBannerAction() {
        $em = $this->getDoctrine()->getManager();
        $banner = $em->getRepository('projectAdminloginBundle:Banner')->findAll();
        $mensaje = '';
        return $this->render('projectAdminloginBundle:Default:listarBanner.html.twig', array('banner'=>$banner , 'mensaje' => $mensaje));
    }
    
    public function vistaFormularioEditarBannerAction($id) {
        $session = $this->getRequest()->getSession();
        
        $session->set('idBanner' , $id);
        $em = $this->getDoctrine()->getManager();
        $banner = $em->getRepository('projectAdminloginBundle:Banner')->find($id);
        return $this->render('projectAdminloginBundle:Default:editarBanner.html.twig', array('banner'=>$banner));
    }
    
    public function eliminarBannerAction(Request $request) {
        
        $id = $request->request->get('recordToDelete');
        $em = $this->getDoctrine()->getManager(); 
        $banner = $em->getRepository('projectAdminloginBundle:Banner')->find($id);
        $em->remove($banner);
        $em->flush();
        return new Response('Banner Eliminado');
    }
    
    public function guardarFormularioEditarAction(Request $data) {
        
        $id = $data->request->get('id');
        $nombre = $data->request->get('nombre');
        $titulo  = $data->request->get('titulo');
        $url = $data->request->get('url');
        
        $piedefoto = $data->request->get('piedefoto');
  
        $em = $this->getDoctrine()->getManager();
        $banner = $em->getRepository('projectAdminloginBundle:Banner')->findOneBy(array('id' => $id));
        
        $banner->setNombre($nombre);
        $banner->setTitulo($titulo);

        $banner->setPiedefoto($piedefoto);
        $banner->setUrl($url);
        $banner->setFecha(new \DateTime());
        
        $em->merge($banner);
        $em->flush();
        
        $mensaje = 'Cambiós Slider Guardados';
        $banner = $em->getRepository('projectAdminloginBundle:Banner')->findAll();
        return $this->render('projectAdminloginBundle:Default:listarBanner.html.twig', array('banner'=>$banner , 'mensaje' => $mensaje));
        
        
        
    }
    
    public function uploadImagenAction() {
        return $this->render('projectAdminloginBundle:Default:formularioUploadImagen.html.twig');
    }
    
    public function uploadBannerViewAction(){
        
        
         return $this->render('projectAdminloginBundle:Default:uploadBannerImg.html.twig');
        
    }
    
    public function vistaFormularioCalugaAction() {
        return $this->render('projectAdminloginBundle:Default:formularioCaluga.html.twig');
    }
    
    public function guardarCalugaAction(Request $data) {
        
        $titulo = $data->request->get('titulo');
        $idioma = $data->request->get('idioma');
        $descripcioncorta = $data->request->get('descripcioncorta');
        $descripcion = $data->request->get('descripcion');
        
        $em = $this->getDoctrine()->getManager();
        $caluga = new Caluga();
        
        $caluga->setTitulo($titulo);
        $caluga->setIdioma($idioma);
        $caluga->setDescripcioncorta($descripcioncorta);
        $caluga->setDescripcion($descripcion);
        $caluga->setFecha(new \DateTime());
        
        $em->persist($caluga);
        $em->flush();
        
        $id = $caluga->getId();
        $session = $this->getRequest()->getSession();
        $session->set('calugaId', $id);
        
        
        return $this->redirect('vistaUploadCaluga');
        
       
    }
    
    public function listarCalugasAction() {
        $em = $this->getDoctrine()->getManager();
        $caluga = $em->getRepository('projectAdminloginBundle:Caluga')->findAll();
        return $this->render('projectAdminloginBundle:Default:listarCaluga.html.twig', array('caluga'=>$caluga));
    }
    
    public function vistaEditarCalugaAction($id) {
        $em = $this->getDoctrine()->getManager();
        $caluga = $em->getRepository('projectAdminloginBundle:Caluga')->find($id);
        return $this->render('projectAdminloginBundle:Default:editarCaluga.html.twig', array('caluga'=>$caluga));
    }
    
    public function guardarEditarCalugaAction(Request $data) {
        $id = $data->request->get('id');
        $titulo = $data->request->get('titulo');
        $idioma = $data->request->get('idioma');
        $descripcioncorta = $data->request->get('descripcioncorta');
        $descripcion = $data->request->get('descripcion');
        
        $em = $this->getDoctrine()->getManager();
        $caluga = $em->getRepository('projectAdminloginBundle:Caluga')->findOneBy(array('id' =>$id));
        
        $caluga->setTitulo($titulo);
        $caluga->setIdioma($idioma);
        $caluga->setDescripcioncorta($descripcioncorta);
        $caluga->setDescripcion($descripcion);
        
        $em->merge($caluga);
        $em->flush();
     
        
        
        return $this->redirect('listarCalugas');
    }
    
    public function eliminarCalugaAction(Request $request) {
        
        $id = $request->request->get('recordToDelete');
        $em = $this->getDoctrine()->getManager(); 
        $caluga = $em->getRepository('projectAdminloginBundle:Caluga')->find($id);
        $em->remove($caluga);
        $em->flush();
        return new Response('100');    
    }
    
    public function eliminarFotoProductoAction($id) {
        $em = $this->getDoctrine()->getManager();
        $fotoproducto = $em->getRepository('projectAdminloginBundle:Foto')->find($id);
        $em->remove($fotoproducto);
        $em->flush();
        return new Response('Foto Producto Eliminada');
        
    }
    
    public function eliminarFotoCalugaAction($id){
        $em = $this->getDoctrine()->getManager();
        $fotoCaluga =  $em->getRepository('projectAdminloginBundle:Caluga')->find($id);
        $em->remove($fotoCaluga);
        $em->flush();
        return new Response('Foto Caluga Eliminada');
        
    }
    
    public function eliminarFotoBannerAction(Request $data) {
        $id = $data->request->get('recordToDelete');
        
        $em = $this->getDoctrine()->getManager();
        $fotobanner = $em->getRepository('projectAdminloginBundle:Banner')->find($id);
        $em->remove($fotobanner);
        $em->flush();
        return new Response('Foto Banner Eliminada');
        
    }
    
    public function vistaFormularioSegundoBannerAction(){
        return $this->render('projectAdminloginBundle:Default:formularioSegundoBanner.html.twig');
    }
    
    public function guardarFormularioSegundoBannerAction(Request $data) {
        
        $nombre = $data->request->get('nombre');
        $idioma = $data->request->get('idioma');
        $link = $data->request->get('link');
        
        $em = $this->getDoctrine()->getManager();
        $segundobanner = new Banner2();
        
        $segundobanner->setNombre($nombre);
        $segundobanner->setIdioma($idioma);
        $segundobanner->setLink($link);
        
        $em->persist($segundobanner);
        $em->flush();
        
        $idSegundoBanner = $segundobanner->getId();
        $session = $this->getRequest()->getSession();
        $session->set('idSegundoBanner', $idSegundoBanner);
        
        return $this->redirect('vistaUploadSegundoBanner');
    }
    
    public function vistaUploadSegundoBannerAction() {
        return $this->render('projectAdminloginBundle:Default:uploadSegundoBanner.html.twig');
        
    }
    
    public function uploadSegundoBannerAction() {
        $session = $this->getRequest()->getSession();
        $idsbanner = $session->get('idSegundoBanner');
        $idSegundoBanner = $idsbanner;
        
    
                
        $fileName = ($_REQUEST["name"]);
        
        
        
        $targetDirectorio = 'segundoBanner/' . $idSegundoBanner . '/' . $fileName;
        if (file_exists($targetDirectorio)) {
        } else {
            //   mkdir('fotos/', 0777, true);
        }



        $targetDir = 'segundoBanner/' . $idSegundoBanner . '/';

        //$targetDir = 'uploads';

        $cleanupTargetDir = true; 
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        @set_time_limit(5 * 60);


        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';


        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


        if (!file_exists($targetDir))
            @mkdir($targetDir);


        if ($cleanupTargetDir) {
            if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
        }

        $uno = 'uno';
          
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];


        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {

                    $in = @fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    }
                    else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    @fclose($in);
                    @fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = @fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                @fclose($in);
                @fclose($out);
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);
            $em = $this->getDoctrine()->getManager();
            $segundoBanner = $em->getRepository('projectAdminloginBundle:Banner2')->findOneBy(array('id' => $idSegundoBanner));

            $segundoBanner->setUrl($fileName);
            $em->persist($segundoBanner);
            $em->flush();
            
        }
        return new Response($fileName);
   }
    
   public function listarSegundoBannerAction() {
       $em  = $this->getDoctrine()->getManager();
       $segundoBanner = $em->getRepository('projectAdminloginBundle:Banner2')->findAll();
       return $this->render('projectAdminloginBundle:Default:listarSegundoBanner.html.twig', array('segundobanner'=> $segundoBanner));
       
   }
   public function eliminarSegundoBannerAction(Request $data) {
        $id = $data->request->get('recordToDelete');
        $em = $this->getDoctrine()->getManager(); 
        $bannerdos = $em->getRepository('projectAdminloginBundle:Banner2')->find($id);
        $em->remove($bannerdos);
        $em->flush();
        return new Response('Banner Eliminado'); 
   }
   
   public function vistaEditarSegundoBannerAction($id) {
       $em = $this->getDoctrine()->getManager();
       $session = $this->getRequest()->getSession();
       
       $session->set('idSegundoBanner', $id);
       $segundobanner = $em->getRepository('projectAdminloginBundle:Banner2')->find($id);
       return $this->render('projectAdminloginBundle:Default:editarSegundoBanner.html.twig', array('segundobanner' => $segundobanner));
   }
   
   public function guardarEditarSegundoBannerAction(Request $data) {
       $id = $data->request->get('id');
       $nombre = $data->request->get('nombre');
       $idioma =  $data->request->get('idioma');
       $link  = $data->request->get('link');
       
       $em = $this->getDoctrine()->getManager();
       
       $segundobanner = $em->getRepository('projectAdminloginBundle:Banner2')->findOneBy(array('id'=>$id));
       
       $segundobanner->setNombre($nombre);
       $segundobanner->setIdioma($idioma);
       $segundobanner->setLink($link);
       
       $em->merge($segundobanner);
       $em->flush();
       
       return $this->redirect('listarSegundoBanner');
       
   }
   
   public function vistaFormularioArticuloAction() {
       return $this->render('projectAdminloginBundle:Default:formularioArticulo.html.twig');
       
   }
   
   public function guardarFormularioArticuloAction(Request $dataarticulo) {
       $titulo =  $dataarticulo->request->get('titulo');
       $idioma =  $dataarticulo->request->get('idioma');
       $descripcioncorta = $dataarticulo->request->get('descripcioncorta');
       $articulo = $dataarticulo->request->get('articulo');
       
       $em = $this->getDoctrine()->getManager();
       $entidadarticulo = new Articulo();

       $entidadarticulo->setTitulo($titulo);
       $entidadarticulo->setIdioma($idioma);
       $entidadarticulo->setDescripcioncorta($descripcioncorta);
       $entidadarticulo->setArticulo($articulo);
       
       $em->persist($entidadarticulo);
       $em->flush();
       
        $idArticulo = $entidadarticulo->getId();
        $session = $this->getRequest()->getSession();
        $session->set('idArticulo', $idArticulo);

       
       return $this->redirect('vistaUploadFotoArticulo');
       
   }
   
   
   
   public function vistaUploadFotoArticuloAction() {
       return $this->render('projectAdminloginBundle:Default:uploadArticulo.html.twig');
   }
   
   public function uploadArticuloAction() {
        $session = $this->getRequest()->getSession();
        $id = $session->get('idArticulo');
        $idarticulo = $id;
        
    
                
        $fileName = ($_REQUEST["name"]);
        
        $targetDirectorio = 'articulo/' . $idarticulo . '/' . $fileName;
        if (file_exists($targetDirectorio)) {
        } else {
            //   mkdir('fotos/', 0777, true);
        }



        $targetDir = 'articulo/' . $idarticulo . '/';

        //$targetDir = 'uploads';

        $cleanupTargetDir = true; 
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        @set_time_limit(5 * 60);


        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';


        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


        if (!file_exists($targetDir))
            @mkdir($targetDir);


        if ($cleanupTargetDir) {
            if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
        }

        $uno = 'uno';
          
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];


        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {

                    $in = @fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    }
                    else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    @fclose($in);
                    @fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = @fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                }
                else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                @fclose($in);
                @fclose($out);
            }
            else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $filePath);
            $em = $this->getDoctrine()->getManager();
            $articulo = $em->getRepository('projectAdminloginBundle:Articulo')->findOneBy(array('id' => $idarticulo));

            $articulo->setUrl($fileName);
            $em->persist($articulo);
            $em->flush();
            
        }
        return new Response($fileName);
   }
   
   public function listarArticulosAction() {
       $em = $this->getDoctrine()->getManager();
       $articulo = $em->getRepository('projectAdminloginBundle:Articulo')->findAll();
       return $this->render('projectAdminloginBundle:Default:listarArticulo.html.twig', array('articulo' => $articulo));
   }
   
   public function eliminarArticuloAction(Request $data) {
        $id = $data->request->get('recordToDelete');
        $em = $this->getDoctrine()->getManager(); 
        $articulo = $em->getRepository('projectAdminloginBundle:Articulo')->find($id);
        $em->remove($articulo);
        $em->flush();
        return new Response('Articulo Eliminado'); 
   }
   

   public function vistaFormularioEditarArticuloAction($id) {
       $em = $this->getDoctrine()->getManager();
       $articulo = $em->getRepository('projectAdminloginBundle:Articulo')->find($id);
       return $this->render('projectAdminloginBundle:Default:editarArticulo.html.twig', array('articulo' => $articulo));
   }
   
   public function guardarEditarArticuloAction(Request $dataarticulo) {
       
       $id = $dataarticulo->request->get('id');
       $titulo = $dataarticulo->request->get('titulo');
       $idioma = $dataarticulo->request->get('idioma');
       $descripcioncorta = $dataarticulo->request->get('descripcioncorta');
       $articulo = $dataarticulo->request->get('articulo');
       
       $em = $this->getDoctrine()->getManager();
       $entidadArticulo = $em->getRepository('projectAdminloginBundle:Articulo')->findOneBy(array('id'=>$id));
       
       $entidadArticulo->setTitulo($titulo);
       $entidadArticulo->setIdioma($idioma);
       $entidadArticulo->setDescripcioncorta($descripcioncorta);
       $entidadArticulo->setArticulo($articulo);
       
       $em->merge($entidadArticulo);
       $em->flush();
       
       $idArticulo = $entidadArticulo->getId();
       $session = $this->getRequest()->getSession();
       $session->set('idArticulo', $idArticulo);

       
       return $this->redirect('vistaUploadFotoArticulo');
       
   }
   
   public function eliminarFotoArticuloAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $idfoto = $request->request->get('recordToDelete');
        
      
        $fotoArticulo = $em->getRepository('projectAdminloginBundle:Articulo')->find($idfoto);

 

        $em->remove($fotoArticulo);
        $em->flush();
        return new Response('Foto Eliminada');
   }
   
   
  
}

