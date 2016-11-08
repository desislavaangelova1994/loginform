<?php

use Yee\Managers\Controller\Controller;
use Yee\Yee;
use Yee\Managers\RoutingCacheManager;
use Yee\Managers\CacheManager;
use App\Models\DeptTableEditModel;
use App\Models\DeptTableModel;
use App\Models\DeleteDeptModel;


class DepTableEditController extends \Yee\Managers\Controller\Controller
{

    /**
     * @Route('/depttable/:ID')
     * @Name('Department')
     */
    public function index($ID)
    {
        $app=$this->getYee(); //$app = new Yee() 

        $data = array('content' => $ID,
                     'id'=>$ID
                     );       

        $app->render('EditDepartment.twig',$data);
    }

     /**
     * @Route('/depttable1/:ID')
     * @Name('sucess')
     * @Method('Post')
     */
    public function editData($ID){

        $app = $this->getYee();

        $Name = $app->request()->post('Name');
        
        $result = new DeptTableEditModel($ID,$Name);
        $data = $result->EditDeptData();

        if($data == true)
        {
            $DeptTableModel = new DeptTableModel( );
            $data1 = $DeptTableModel->publishLists();
            $data = array(
                   'content' => $data1
                   );

             $app->render('departmentdb.twig',$data);

        }else
        {
            $error='Please enter valid data!';
            $data = array(
                        'error' => $error
                        );
            $app->render('EditDepartment.twig',$data);


        }
    }

     /**
     * @Route('/depttable1/:ID')
     * @Name('data.index')
     */
    public function deleteDataAction($ID)
    {
        $app = $this->getYee();

        $result = new DeleteDeptModel($ID);
        $res = $result->deleteDept();

        $DeptTableModel = new DeptTableModel( );
        $data1 = $DeptTableModel->publishLists();
        $data = array(
                 'res'=> $res,
                'content' => $data1
                 );

        $app->render('departmentdb.twig',$data);
    }

    
}

