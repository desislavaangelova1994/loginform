<?php
    use Yee\Yee;
    use Yee\Managers\CacheManager;
    use Yee\Managers\Controller\Controller;
    use App\Models\AddDeptModel;
    use App\Models\DeptTableModel;

class AddDepartmentController extends Controller
{
    /**
     * @Route('/depttableadd')
     * @Name('Add.Department')
     */
    public function index1(){
         $app=$this->getYee(); //$app = new Yee()     
      

        $app->render('AddDepartment.twig',$data = array());
        
    }

    /**
    * @Route('/dep')
    * @Name('adddept.post')
    * @Method('POST')
    */
    public function addNew()
    {
        $app= $this->getYee();

        $Name = $app->request->post('Name');

        $deptnew = new AddDeptModel($Name);
        $addDept = $deptnew-> insertDepartment();

        if ($addDept === true)
        {
            $DeptTableModel = new DeptTableModel( );
            $data1 = $DeptTableModel->publishLists();
            $data = array(
                   'content' => $data1
                   );

             $app->render('departmentdb.twig',$data);
        }
        else{
            $error = "Error!";
            $data = array(
                        'error'=>$error
                        );
            $app->render('AddDepartment.twig',$data);
        }
    }       
}

