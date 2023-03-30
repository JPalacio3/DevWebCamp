<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;

class PaginasController
{
    public static function index(Router $router)
    {

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
        ]);
    }

    public static function evento(Router $router)
    {

        $router->render('paginas/sobredevwebcamp', [
            'titulo' => 'Sobre DevWebCamp',
        ]);
    }

    public static function paquetes(Router $router)
    {

        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp',
        ]);
    }

    public static function conferencias(Router $router)
    {
        $eventos = Evento::ordenarLista('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);


            // Consulta para las conferencias del día viernes
            if ($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_v'][] = $evento;
            }

            // Consulta para las conferencias del día sábado
            if ($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_s'][] = $evento;
            }

            // Consulta para los Workshops del día viernes
            if ($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_v'][] = $evento;
            }

            // Consulta para las conferencias del día sábado
            if ($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $router->render('paginas/workshops-conferencias', [
            'titulo' => 'Conferencias & WorkShops',
            'eventos' => $eventos_formateados,
        ]);
    }
}