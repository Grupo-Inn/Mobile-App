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
        $result = $this->_db->query('SELECT * FROM user');
        
        $users = $result->fetch_all(MYSQLI_ASSOC);
        
        return $users;
    }

    public function get_user($a_username, $a_password)
    {
        $result = $this->_db->query("SELECT * FROM grupo_inn_db.user WHERE grupo_inn_db.user.username = LOWER('" . $a_username . "') AND grupo_inn_db.user.password = '" . $a_password . "'");

        $user = $result->fetch_all(MYSQLI_ASSOC);
        
        return $user;
    }

    public function new_user($a_username, $a_password)
    {
        $user = $this->_db->query('INSERT INTO grupo_inn_db.user (username, password) VALUES ("'.$a_username.'", "'.$a_password.'") ');
        
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
        $result = $this->_db->query('SELECT * FROM event ORDER BY name');

        $events = $result->fetch_all(MYSQLI_ASSOC);
        
        return $events;
    }

    public function get_event($a_id)
    {
        $result = $this->_db->query('SELECT * FROM event WHERE event.id = '.$a_id);

        $event = $result->fetch_all(MYSQLI_ASSOC);
        
        return $event;
    }
    public function get_profiles($a_id)
    {
        $result = $this->_db->query('SELECT profile.names, profile.image FROM profile, event_has_user, user WHERE event_has_user.Event_id = "'.$a_id.'" AND user.id = event_has_user.User_id AND profile.id = user.id');

        $profiles = $result->fetch_all(MYSQLI_ASSOC);

        return $profiles;
    }
    public function get_num_profiles($a_id)
    {
        $result = $this->_db->query('SELECT COUNT(*) FROM profile, event_has_user, user WHERE event_has_user.Event_id = "'.$a_id.'" AND user.id = event_has_user.User_id AND profile.id = user.id');

        $num = $result->fetch_all(MYSQLI_ASSOC);

        return $num;
    }
    public function join($a_event, $a_user)
    {
        $result = $this->_db->query('INSERT INTO event_has_user VALUES ('.$a_event.', '.$a_user.')');
        
        return $result;
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
        $result = $this->_db->query('SELECT * FROM profile');

        $profiles = $result->fetch_all(MYSQLI_ASSOC);
        
        return $profiles;
    }

    public function get_profile($a_id)
    {
        $result = $this->_db->query('SELECT * FROM profile WHERE profile.id = '.$a_id);

        $profile = $result->fetch_all(MYSQLI_ASSOC);
        
        return $profile;
    }

    public function get_profile_likes($a_id)
    {
        $result = $this->_db->query('SELECT grupo_inn_db.like.name FROM grupo_inn_db.like, user_has_like WHERE ((user_has_like.User_id = "'.$a_id.'") AND (like.id = user_has_like.Like_id) )');

        $likes = $result->fetch_all(MYSQLI_ASSOC);

        return $likes;
    }

}

class Like extends modelo
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_likes()
    {
        $result = $this->_db->query('SELECT * FROM grupo_inn_db.like');

        $likes = $result->fetch_all(MYSQLI_ASSOC);

        return $likes;
    }
}
?>