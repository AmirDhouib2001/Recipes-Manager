<?php

namespace recettes;

class Logger
{
    public function generateLoginForm(string $action='/', string $username=null, $message=null): void{
        if (isset($response['error'])): ?>
            <div class="message">
                <?php echo $message ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php $action ?>" class="card" id="login-form">
            <legend style="text-align: center">Please Login</legend>
            <div class="form-group">
                <input type="text" name="username" placeholder="username" value="<?php echo $username ?>" autofocus>
                <input type="password" name="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-outline-danger">LOGIN</button>
        </form>
        <?php
    }
    public function log(string $username, string $password) : array{

    // les data devraient être récupérées dans une base de données...
        $user = "admin" ;
        $pwd = "admin" ;

        $error = null ;
        $nick = null ;
        $granted = false ;
        if (empty($username)){
            $error = "USERNAME IS EMPTY" ;
        }elseif (empty($password)){
            $error = "PASSWORD IS EMPTY" ;
        }elseif ($user == $username and $pwd == $password){
            $granted = true ;
            $nick = htmlspecialchars("Admin") ; // devrait provenir d'un BD...
        }else{
            $error = "AUTHENTIFCATION FAILED" ;
        }
        return array(
        'granted' => $granted,
        'nick' => $nick,
        'error' => $error
        ) ;

    }
}

