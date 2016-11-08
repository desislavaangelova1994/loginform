<?php

use Yee\Managers\Controller\Controller;
use Yee\Yee;
use Yee\Managers\RoutingCacheManager;
use Yee\Managers\CacheManager;
use App\Models\DepartmentModel;

class DepController extends \Yee\Managers\Controller\Controller
{

    /**
     * @Route('/department')
     * @Name('dept')
     */
    public function index()
    {
        $app=$this->getYee(); //$app = new Yee()        

        $app->render('department.twig',$data = array());
    }

     /**
     * @Route('/department')
     * @Name('sucess')
     * @Method('Post')
     */
    public function success(){
        $app=$this->getYee(); //$app = new Yee()
        $name = $app->request->post('depvalue');
        $dept = new DepartmentModel($name);
        $department = $dept->insertDeptData();

        if($department == false ){
            $error = "Error!";
            $data = array(
                        'error' => $error
                        );
        }
        else
        {
            $success = "Success!!!";
            $data = array(  'success' => $success );
          
        }

        $app->render('department.twig',$data);
 }
    // public function sucess()
    // {
    //     $app=$this->getYee(); //$app = new Yee()
    //     $name = $app->request->post('depvalue');
    //     $dept = new DepartmentModel($name);
    //     $department = $dept ->insertDeptData();
    //     $success = "Success!!!";
    //     $data = array(
    //                 'success' => $success
    //                   );
    //     $app->render('department.twig',$data);
    // }
    // public function error(){
    //      $app=$this->getYee(); //$app = new Yee()
    //     $name = $app->request->post('depvalue');
    //     $dept = new DepartmentModel($name);
    //     $error = "Error!";
    //     $data = array(
    //                 'error'=>$error
    //                 );
    //     $app->render('department.twig',$data);
    // }
        
}