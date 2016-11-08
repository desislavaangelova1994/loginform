<?php 
use Yee\Yee;
use Yee\Managers\Controller\Controller;
use Yee\Managers\RoutingCacheManager;
use Yee\Managers\CacheManager;
use App\Models\LoginModel;


class LoginController extends Controller{

	/**
     * @Route('/login')
     * @Name('index')
     */
	public function showForm(){

		$app = $this->getYee();

        $app->render('login.twig',$data = array());
	}

	/**
     * @Route('/loginform')
     * @Name('index')
     * @Method('POST')
     */
	public function afterPost(){

		$app = $this->getYee();
		$name = $app->request->post('myname');
		$password = $app->request->post('mypassword');
		$loginModel = new LoginModel();


	
		// $message = $loginModel->checkUsername($name);
		// $alertpass = $loginModel->checkPassword($password);

		// if(!$loginModel->checkAdminPass($password)){
		// 	$error = "Your Password is not correct";
		// }
		// var_dump($loginModel->checkAdminname($name));
		// var_dump($loginModel->checkAdminPass($password));
		// die;

		// var_dump((!$loginModel->checkAdminname($name)) || (!$loginModel->checkAdminPass($password)));
		// var_dump(!$loginModel->checkUsername($name) || (!$loginModel->checkUserPass($password)));
		// 	die;

		if( $loginModel->checkAdminname($name) && $loginModel->checkAdminPass($password) )
		{
			$success=true;
		}
		else if($loginModel->checkUsername($name) && $loginModel->checkUserPass($password) )
        { 
        	$success= true;
        }
        else
        {
        	$success = false;
        	$error = "Your password or username is not correct";
        }
		
		if($success){
					$data = array(
					'message' => "success",
					'user'=>$name);
			$app ->render('welcome.twig',$data);
		}
		else{
			$data = array(
				'message'=>'Username or password are wrong',
						);
			$app->render('login.twig',$data);
		}
		//  if(empty($name))
		// {
		// 	$message = 'Please,insert some data!';
		// }
		// else if(is_numeric($name))
		// {
		// 	$message = 'Please,insert text only!';
		// }
		// else
		// {
		// 	$message = "success";
		// // }

		// $data = array(
					
		// 			'message' => $message ,
		// 			'alertpass'=> $alertpass
		// 			 );

  //       $app->render('login.twig', $data);
	}
}