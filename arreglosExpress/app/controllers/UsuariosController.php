<?php 
class UsuariosController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function mostrarUsuarios()
    {
        $usuarios = Usuario::all(); 
        
        return View::make('Usuario.test', array('usuarios' => $usuarios));
    }
 
}
?>