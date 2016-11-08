<?php

use Yee\Yee;
use Yee\Managers\CacheManager;
use Yee\Managers\Controller\Controller;
use App\Models\AddEmployeeModel;
use App\Models\EmployeeEditModel;
use App\Models\EmpTableModel;

class TestController extends Controller
{
	/**
	 * @Route('/ok')
	 * @Name('test.index')
	 * @Method('POST')
	 */
	public function indexAction()
	{
		$app= $this->getYee();
        
        $FirstName = $app->request->post('FirstName');
        $LastName = $app->request->post('LastName');
        $DepId = $app->request->post('DepID');
        $EGN = $app->request->post('EGN');
        // var_dump($DepId);die;
        $employee = new AddEmployeeModel($FirstName,$LastName,$DepId,$EGN);
        $addEmploy = $employee->AddEmp();
        $egn = $employee->egn_valid();
        // var_dump($addEmploy && $egn);die;

        if($addEmploy && $egn === true ){

            $EmpTableModel = new EmpTableModel( );
            $data1 = $EmpTableModel->publishLists();


             $data = array(
                'content' => $data1,
                 );

             $app->render('employeedb.twig',$data);

        }
        else if (empty($addEmploy) || empty($egn))
        {   
            $error1 = "Please fill out the empty input";

            $data = array(
                    'content' => $error1
                    );
            $app->render('AddEmployee.twig',$data);
        }
        else{
        	$error = "Error!";
            $data = array(
                         'error'=>$error
                        );
            $app->render('AddEmployee.twig',$data);
        }
	}
}