<?php

require_once "model.php";

class User extends Modelo
{    
    public function __construct()
    {
        parent::__construct();
    }
    public function __destruct()
    {
        parent::__destruct();
    }

    public function get_users()
    {
        $result = $this->_db->query('SELECT * FROM usuarios');
        
        $users = $result->fetch_all(MYSQLI_ASSOC);
        
        return $users;
    }

    public function get_user($a_username, $a_password)
    {
        $result = $this->_db->query("SELECT * FROM grupo_inn_db.Usuario WHERE grupo_inn_db.Usuario.nombre = LOWER('" . $a_username . "') AND grupo_inn_db.Usuario.clave = '" . $a_password . "'");

        $user = $result->fetch_all(MYSQLI_ASSOC);
        
        return $user;
    }
} 

class Event extends modelo
{
    
    function __construct()
    {
        parent::__construct();
    }
    public function __destruct()
    {
        parent::__destruct();
    }

    public function get_events()
    {
        $result = $this->_db->query('SELECT * FROM grupo_inn_db.Evento ORDER BY nombre');

        $events = $result->fetch_all(MYSQLI_ASSOC);
        
        return $events;
    }

    public function get_event($a_id)
    {
        $result = $this->_db->query('SELECT * FROM grupo_inn_db.Evento WHERE grupo_inn_db.Evento.idEvento = '.$a_id);

        $event = $result->fetch_all(MYSQLI_ASSOC);
        
        return $event;
    }
}

class Profile extends modelo
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function get_profiles()
    {
        $result = $this->_db->query('SELECT * FROM grupo_inn_db.Perfil');

        $profiles = $result->fetch_all(MYSQLI_ASSOC);
        
        return $profiles;
    }

    public function get_profile($a_id)
    {
        $result = $this->_db->query('SELECT * FROM grupo_inn_db.Perfil WHERE grupo_inn_db.Perfil.idPerfil = '.$a_id);

        $profile = $result->fetch_all(MYSQLI_ASSOC);
        
        return $profile;
    }
}
?>