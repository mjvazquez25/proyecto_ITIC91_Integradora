<?php

class AuthController extends BaseController {
    
    /**
     * Muestra el formulario para login.
     */
    public function showLogin()
    {
        // Verificamos que el usuario no esta autenticado
        if (Auth::check())
        {
            // Si esta autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('/');
        }
                
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('Admin.login');
    }
    
    /**
     * Valida los datos del usuario.
     */
    public function postLogin()
    {
        
//        // Guardamos en un arreglo los datos del usuario.
//        $userdata = array(
//            'dsUsuario' => $_POST('usuario'),
//            'dsPassword' => $_POST('password')
//        );
//        print_r($userdata); //die();
        $results = DB::select('select * from cusuario where id = ?',array(1));
        print_r($results); die();
        
//        return View::make('Admin.login');
        
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        /*if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/');
        }*/
        
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
//        return Redirect::to('Admin')
//                    ->with('mensaje_error', 'Tus datos son incorrectos')
//                    ->withInput();
    }
}