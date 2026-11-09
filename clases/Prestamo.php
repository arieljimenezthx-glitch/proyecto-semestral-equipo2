<?php
defined('APP_ACCESO') or exit('Acceso denegado');

class Prestamo
{
    private $codigo;
    private $correo;
    private $fechaPrestamo;
    private $fechaDevolucion;
    private $estado;

    public function __construct($codigo, $correo, $fechaPrestamo, $fechaDevolucion, $estado)
    {
        $this->setCodigo($codigo);
        $this->setCorreo($correo);
        $this->setFechaPrestamo($fechaPrestamo);
        $this->setFechaDevolucion($fechaDevolucion);
        $this->setEstado($estado);
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

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        $this->correo = $correo;
        return true;
    }

    public function getFechaPrestamo()
    {
        return $this->fechaPrestamo;
    }

    public function setFechaPrestamo($fecha)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return false;
        }
        $this->fechaPrestamo = $fecha;
        return true;
    }

    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    public function setFechaDevolucion($fecha)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return false;
        }
        $this->fechaDevolucion = $fecha;
        return true;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        if (!in_array($estado, ['Activo', 'Vencido', 'Devuelto'], true)) {
            return false;
        }
        $this->estado = $estado;
        return true;
    }

    public function estaVencido()
    {
        return $this->estado === 'Vencido';
    }
}
