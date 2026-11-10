<?php
defined('APP_ACCESO') or exit('Acceso denegado');

class Equipo
{
    private $codigo;
    private $nombre;
    private $categoria;
    private $enReparacion;

    public function __construct($codigo, $nombre, $categoria, $enReparacion)
    {
        $this->setCodigo($codigo);
        $this->setNombre($nombre);
        $this->setCategoria($categoria);
        $this->setEnReparacion($enReparacion);
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        if (!preg_match('/^[A-Z]{3}-[0-9]{5}$/', $codigo)) {
            return false;
        }
        $this->codigo = $codigo;
        return true;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        if (strlen($nombre) < 3 || strlen($nombre) > 80) {
            return false;
        }
        $this->nombre = $nombre;
        return true;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        if (!in_array($categoria, ['Electrónica', 'Medición', 'Redes', 'Kit', 'Cómputo', 'Cable o accesorio'], true)) {
            return false;
        }
        $this->categoria = $categoria;
        return true;
    }

    public function getEnReparacion()
    {
        return $this->enReparacion;
    }

    public function setEnReparacion($valor)
    {
        if (!is_bool($valor)) {
            return false;
        }
        $this->enReparacion = $valor;
        return true;
    }

    public function estaDisponible()
    {
        return $this->enReparacion === false;
    }
}
