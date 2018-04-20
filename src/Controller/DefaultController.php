<?php
// GestionASM17/src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function membres()
    {
        

        return $this->render('GestionASM17/membres.html.twig');
    }
}
