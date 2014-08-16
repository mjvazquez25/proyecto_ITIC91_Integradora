<?php

class AuthController extends BaseController {
    
    /**
     * Muestra el formulario para login.
     */
    public function showLogin()
    {
        // Verificamos que el usuario no esta autenticado
//        if (Auth::check())
//        {
//            // Si esta autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
//            return Redirect::to('/');
//        }
                
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('Admin.login');
    }
    
    /**
     * Valida los datos del usuario.
     */
    public function postLogin()
    {
        //validar datos de entrada
        if(!isset($_POST)){
                    return Redirect::to('Admin')
                    ->with('mensaje_error', 'Debes ingresar los datos de autenticacion')
                    ->withInput();
        }
//        $results = DB::select('select * from cusuario where dsUsuario = ? and dsPassword= ?',
//                                array(
//                                    (string)$_POST['usuario'],
//                                    (string)$_POST['password']
//                            ));
        
        //validar que se haya encontrado al usuario, en caso contrario redirecionar al index
        if (Auth::attempt(array('dsUsuario' => (string)$_POST['usuario'], 'password' =>  (string)$_POST['password']), false)){
            
            //De ser datos válidos nos mandara a la pantalla principal del administrador
            return Redirect::to('HomeAdmin');            
        }else{
           return Redirect::to('Admin')
                    ->with('mensaje_error', 'Datos de logueo incorrectos')
                    ->withInput();             
        }
        
    }
    
    public function logOut()
    {
        //Session::forget('cnSessionValida');
        Auth::logout();
        return Redirect::to('Admin');
    }
}