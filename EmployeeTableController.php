<?php
 
use Yee\Managers\Controller\Controller;
use Yee\Yee;
use Yee\Managers\RoutingCacheManager;
use Yee\Managers\CacheManager;
use App\Models\EmpTableModel;

class EmployeeTableController extends Controller
{

    /**
     * @Route('/log1')
     * @Name('log1')
     */
    public function index()
    {
        $app=$this->getYee(); //$app = new Yee()        

        $app->render('log1.twig',$data = array());
    }

     /**
     * @Route('/emptable')
     * @Name('employeetableshow')
     * @Method('Post')
     */
    public function test()
    {
        $app = $this->getYee();
        
        $EmpTableModel = new EmpTableModel( );
        $data1 = $EmpTableModel->publishLists();
        $data = array(
                'content' => $data1
                 );
           
            $app->render('employeedb.twig', $data);
    }
    
}