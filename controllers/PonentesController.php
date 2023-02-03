<?php

namespace Controllers;

use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{

    public static function index(Router $router)
    {
        $ponente = Ponente::all();





        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponente,
        ]);
    }



    public static function crear(Router $router)
    {
        $alertas = [];
        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
        ]);
    }
}
