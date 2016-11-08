<?php

use Yee\Yee;
use Yee\Managers\CacheManager;
use Yee\Managers\Controller\Controller;
use App\Models\EmployeeEditModel;
use App\Models\EmpTableModel;
use App\Models\DeleteModel;

class EmployeeEditController extends Controller
{

    /**
     * @Route('/emptable/:EmployeeID')
     * @Name('editEmployee')
     */
    public function editData($EmployeeID)
    {
        $app = $this->getYee();

        $empTable = new EmpTableModel();

        $data = array(
            'content' => $EmployeeID,
            'emp_id' => $EmployeeID,
            'Name' => $empTable->department(),
            );

        $app->render('EditEmployee.twig', $data);


    }

    /**
     * @Route('/emptable2/:EmployeeID')
     * @Name('data.index')
     * @Method('post')
    */
    public function postUpdateData($EmployeeID)
    {
        $app = $this->getYee();

        $FirstName = $app->request()->post('FirstName');
        $LastName = $app->request()->post('LastName');
        $DepID = $app->request()->post('DepID');
        $EGN = $app->request()->post('EGN');

        $result = new EmployeeEditModel($EmployeeID, $FirstName, $LastName, $DepID,$EGN);
        $data = $result->updateInfo();
        $egn = $result->egn_valid();


        if ($data && $egn === true)
        {
        $EmpTableModel = new EmpTableModel( );
        $data1 = $EmpTableModel->publishLists();
        $data = array(
                'content' => $data1
                 );

        $app->render('employeedb.twig',$data);
        }
        else{
            $error = "Please enter the correct data!";

            $data = array(
                        'error'=>$error
                        );
            $app->render('EditEmployee.twig',$data);

        }
    }


     /**
     * @Route('/emptable1/:EmployeeID')
     * @Name('deleteEmployee')
     */
    public function deleteDataAction($EmployeeID)
    {
        $app = $this->getYee();

        $result = new DeleteModel($EmployeeID);
        $res = $result->deleteEmp();

        $EmpTableModel = new EmpTableModel( );
        $data1 = $EmpTableModel->publishLists();
        $data = array(
                 'res'=> $res,
                'content' => $data1
                 );

        $app->render('employeedb.twig',$data);
    }

   
}
