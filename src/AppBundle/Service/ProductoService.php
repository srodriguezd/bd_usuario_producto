<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27/11/15
 * Time: 2:38
 */

namespace AppBundle\Service;
use Symfony\Component\HttpFoundation\Session;


class ProductoService
{
    private $nombre;
    private $precio;
    private $descripcion;
    private $disponibilidad;

    public function newProducto($nombre, $precio, $descripcion, $disponibilidad){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->disponibilidad = $disponibilidad;
    }
}