<?php
 
use Yee\Managers\Controller\Controller;
use Yee\Yee;
use Yee\Managers\RoutingCacheManager;
use Yee\Managers\CacheManager;
use App\Models\DeptTableModel;

class DepttableController extends Controller
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
     * @Route('/depttable')
     * @Name('log)
     * @Method('Post')
     */
    public function test()
    {
        $app = $this->getYee();
        
        $DeptTableModel = new DeptTableModel( );
        $data1 = $DeptTableModel->publishLists();
        $data = array(
                'content' => $data1
                 );
           
            $app->render('departmentdb.twig', $data);
    }
}