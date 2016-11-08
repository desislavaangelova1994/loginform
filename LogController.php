<?php
 
use Yee\Managers\Controller\Controller;
use Yee\Yee;
use Yee\Managers\RoutingCacheManager;
use Yee\Managers\CacheManager;
use App\Models\LogModel;

class LogController extends Controller
{

    /**
     * @Route('/log')
     * @Name('log1')
     */
    public function index()
    {
        $app=$this->getYee(); //$app = new Yee()        

        $app->render('log.twig',$data = array());
    }

     /**
     * @Route('/logs')
     * @Name('log)
     * @Method('Post')
     */
    public function test()
    {
        $app=$this->getYee(); //$app = new Yee()
        $username = $app->request->post('myname');
        $password = $app->request->post('mypassword');
        $usermodel = new LogModel($username,$password);
        $user = $usermodel ->getUserData();

        if($user != NULL){
            $pass = $usermodel->validatePass();
            if($pass == true){
                $data = array(
                              'username' => $user['Username'],
                              );

                $app->render('log1.twig',$data);
            }
            else
            {
            
                 $error = "Wrong data!!!";
                 $data = array(
                        'error'=> $error
                        );
                $app->render('log.twig',$data);
        
            }       
        }           
        else
            {
            
                 $error = "Wrong data!!!";
                 $data = array(
                        'error'=> $error
                        );
                $app->render('log.twig',$data);
        
            }

    }
    
}