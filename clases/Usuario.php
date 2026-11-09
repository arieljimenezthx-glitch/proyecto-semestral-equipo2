<?php
defined('APP_ACCESO') or exit('Acceso denegado');

class Usuario
{
    private $correo;
    private $rol;
    private $hash;

    public function __construct($correo, $rol, $hash)
    {
        $this->setCorreo($correo);
        $this->setRol($rol);
        $this->hash = $hash;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false || !preg_match('/@utp\.ac\.pa$/', $correo)) {
            return false;
        }
        $this->correo = $correo;
        return true;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        if (!in_array($rol, ['estudiante', 'docente', 'laboratorista', 'administrador'], true)) {
            return false;
        }
        $this->rol = $rol;
        return true;
    }

    public function establecerContrasena($contrasena)
    {
        if (strlen($contrasena) < 8 || strlen($contrasena) > 64) {
            return false;
        }
        $this->hash = password_hash($contrasena, PASSWORD_DEFAULT);
        return true;
    }

    public function verificarContrasena($contrasena)
    {
        return password_verify($contrasena, $this->hash);
    }
}
