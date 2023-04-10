<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{

    public static function index(Router $router)
    {

        if (!is_admin()) {
            header('Location: /login');
        }

        // Siempre hay que validar que en la URL haya una página válida para mostrar
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }

        $registros_por_pagina = 6;
        $total = Ponente::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/ponentes?page=1');
        }

        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion(),
        ]);
    }

    public static function crear(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $ponente = new Ponente;
        $redes = json_decode($ponente->redes);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!is_admin()) {
                header('Location: /login');
            }

            // leer imagen
            if (!empty($_FILES['imagen']['tmp_name'])) {

                // Generamos una nueva carpeta para almacenar las imágenes de los ponentes
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 90);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 90);

                // Generar el nombre para cada imagen?
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            }

            // Convertir el arreglo de redes sociales a String para que la función sanitizar pueda ejecutarse y se pueda mandar el archivo sanitizado a la base de datos
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            // Validar
            $alertas = $ponente->validar();

            // Guardar el registro con la imagen
            if (empty($alertas)) {
                // Guardar las imágenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');

                // Guardar en la base de datos
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes,

        ]);
    }

    public static function editar(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];

        // Validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/ponentes');
        }

        // Obteber el ponente a editar
        $ponente = Ponente::find($id);

        if (!$ponente) {
            header('Location: /admin/ponentes');
        }

        // Cargar la imagen del ponente
        $ponente->imagen_actual = $ponente->imagen;

        // Actualizar la imagen
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!is_admin()) {
                header('Location: /login');
            }

            if (!empty($_FILES['imagen']['tmp_name'])) {

                // Generamos una nueva carpeta para almacenar las imágenes de los ponentes
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 90);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 90);

                // Generar el nombre para cada imagen?
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            // Convertir el arreglo de redes sociales a String para que la función sanitizar pueda ejecutarse y se pueda mandar el archivo sanitizado a la base de datos
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if (empty($alertas)) {
                if (isset($nombre_imagen)) {
                    // Guardar las imágenes
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }

                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        // Traer las redes de la base de datos
        $redes = json_decode($ponente->redes);

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes,
        ]);
    }

    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!is_admin()) {
                header('Location: /login');
            }

            if (!is_admin()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if (!isset($ponente)) {
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if ($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}
