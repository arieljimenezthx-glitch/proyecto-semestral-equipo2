<?php
defined('APP_ACCESO') or exit('Acceso denegado');

class Validador
{
    private $errores = [];

    public function requerido($campo, $valor)
    {
        if (trim($valor) === '') {
            $this->errores[] = 'El campo ' . $campo . ' es obligatorio.';
        }
    }

    public function longitud($campo, $valor, $min, $max)
    {
        $largo = strlen($valor);
        if ($largo < $min || $largo > $max) {
            $this->errores[] = 'El campo ' . $campo . ' debe tener entre ' . $min . ' y ' . $max . ' caracteres.';
        }
    }

    public function correo($campo, $valor)
    {
        if (filter_var($valor, FILTER_VALIDATE_EMAIL) === false) {
            $this->errores[] = 'El campo ' . $campo . ' no es un correo válido.';
        }
    }

    public function correoUtp($campo, $valor)
    {
        if (!preg_match('/@utp\.ac\.pa$/', $valor)) {
            $this->errores[] = 'El campo ' . $campo . ' debe terminar en @utp.ac.pa.';
        }
    }

    public function patron($mensaje, $valor, $patron)
    {
        if (!preg_match($patron, $valor)) {
            $this->errores[] = $mensaje;
        }
    }

    public function enLista($campo, $valor, $lista)
    {
        if (!in_array($valor, $lista, true)) {
            $this->errores[] = 'El campo ' . $campo . ' tiene un valor no permitido.';
        }
    }

    public function rango($campo, $valor, $min, $max)
    {
        if (filter_var($valor, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]) === false) {
            $this->errores[] = 'El campo ' . $campo . ' debe ser un número entre ' . $min . ' y ' . $max . '.';
        }
    }

    public function hayErrores()
    {
        return count($this->errores) > 0;
    }

    public function getErrores()
    {
        return $this->errores;
    }
}
