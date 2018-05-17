<?php

/**
* 
*/

/**
* 
*/
class TopChanApi 
{
	public $panel_url = 'http://topchantv.net:3456/';

	public $data = [];

	public $orderHistory = [];  

	public $_post = [];

	public $currentUserId = 0; 

	public $ApiUserData = []; 

	public function __construct($cron = false)
	{
		//if(isset($_POST['userexitst'])){
		 
			if($cron === true){
				return ;
			}
			$this->_post = $_POST; 
			$row_id = $_POST['row_id'];
			if(empty( $_SESSION['ROW_'.$row_id])){
				$this->data['res'] = '/my-account/';
				die;
			}
			// if user was not created before
			if(!empty($_POST['UserName']) and !empty($_POST['UserPass'] )){
				// 1. check if new entered login and password exists
				$post_data = array( 'username' => $_POST['UserName'], 'password' => $_POST['UserPass'] );
				$res = $this->actionInfo($post_data);
				$this->ApiUserData = $res; 
				if(empty($res['user_info'])){
					//create user 
					$info = "User Does not exit!!! processing... \n";

					$link = $this->processingOrder(['action'=>'create']);
					$res['info'] = $info; 
				}else{
					//edit user 
					$link = $this->processingOrder(['action'=>'edit']);
					$res['info'] = "User exits please change"; 
				}
			/** in case user exits */
			}else{ //
				$info = "user exits";
				$link = $this->processingOrder(['action'=>'edit']);
				$res['info'] = $info ; 
			}
			/*$post_data = array( 'username' => $_POST['UserName'], 'password' => $_POST['UserPass'] );
			$res = $this->actionInfo($post_data);
			if(empty($res['user_info'])){
				//create user 
			}else{
				//edit user 
			}*/
			$this->data['link'] = $link;
			$this->data['buket'] = $res['user_info']['bouquet'];
			$this->data['res'] = $res;
			 
		//}
	}

	public function getHistory()
	{
		$id = get_current_user_id();
		$this->currentUserId = $id; 
		$History = str_replace('&quot;', '"',get_field('field_58c78cc396a89', 'user_'.$id));
		return json_decode($History, true);		
	}

	public function processingOrder($params=[])
	{
		$fake_id = 485; 
    	$chan_id = 478; 
    	$ord_id = 421;


		$this->orderHistory =  $this->getHistory(); 
		$oH = $this->orderHistory; 
		$row_id = $_POST['row_id'];
		$post_dat = $_SESSION['ROW_'.$row_id];
		$OrderId = $post_dat['order_id'] / $ord_id;  //isset($_POST['OrderId']) ? $_POST['OrderId'] / $ord_id : '';
		$output = !empty($_POST['ViewType']) ? $_POST['ViewType'] : "ts"; 
		$chan = $post_dat['chan']; 
		$userHistory = str_replace('&quot;', '"', get_field('field_58c78ce0ea6c0', 'user_'.$this->currentUserId)); 
		$userHistory = json_decode($userHistory, true);
		$apiUsername = isset($userHistory['user']) ? $userHistory['user'] : $_POST['UserName'];
		$apiPassword = isset($userHistory['pass']) ? $userHistory['pass'] : $_POST['UserPass']; 

		$this->resetUser($userHistory);

		$order_status = get_field('field_58b84a658e741', $OrderId);

		$newuser = $apiUsername; 
		$newpass = $apiPassword;


		$info =" -----------------";
		$today = time();  

		$expire_date = strtotime( "+1 month" );
		$varList = explode(",", $post_dat['var_id'].",");
		$chanalBouquet = []; 
		$r = 0; 
			foreach (explode(",", $chan.",") as $key => $v) {
				if(!empty($v)){
					$currentChanal = $v / $chan_id; 
					$chanalBouquet[] = $currentChanal;	
					if(!empty($varList[$r])){
						$oH[$currentChanal] = strtotime( "+".$varList[$r]." month" );
					} else{
						$oH[$currentChanal] = $expire_date;	
					}	
				}
				$r++; 					
			}
		
		$allChanIdes = []; 
		foreach ($oH as $key => $v) {
			if($v>$today){
				$allChanIdes[] = $key; 
			}
		}


		if($_POST['UserName'] !== $apiUsername OR $apiPassword !== $_POST['UserPass']){
				$newuser = $_POST['UserName'];
				$newpass = $_POST['UserPass'];
				$user = ['user'=>$newuser, 'pass'=>$newpass, 'id'=>$userHistory['id']]; 
				$usercredentials = json_encode($user); 
				update_field('field_58c78ce0ea6c0', $usercredentials, 'user_'.$this->currentUserId);
				$post_data = array(
			    'username' => $apiUsername,
			    'password' => $apiPassword,
			    'user_data' => array(
			        'max_connections' => 1,
			        'is_restreamer' => 0,
			        'exp_date' => $expire_date, 			        
			        'username'=>$newuser,
			        'password'=>$newpass,
			        'bouquet' => json_encode( $allChanIdes ),
			     ) );

			
				$res = $this->request($path="edit", $post_data, $callback = false);
				
		}


        if('downloaded' == $order_status ){
        	return  "http://topchantv.net:3456/get.php?username=".$newuser."&password=".$newpass."&type=m3u&output=".$output;
        }

       
		$this->data['res']['chanalas'] = $allChanIdes;
		$lastVErsion = json_encode($oH); 
		update_field('field_58c78cc396a89',$lastVErsion, 'user_'.$this->currentUserId);	
		

		update_field('field_58b84a658e741','downloaded', $OrderId);	


		$expire_date = strtotime( "+1 month" );
		$this->data['action'] = $params['action'] ;


		if($params['action']=="create" and  empty($userHistory)){
			$this->data['action'] = "inside create" ;
			$post_data = array( 'user_data' => array(
			        'username' => $_POST['UserName'],
			        'password' => $_POST['UserPass'],
			        'max_connections' => 1,
			        'is_restreamer' => 0,
			        'exp_date' => $expire_date,
			        'bouquet' => json_encode( $allChanIdes ),
			        //'stream_output_format'=>json_encode( array('1', '1','0') ) 
			        ) );
			//die("ok"); 
			$res = $this->request($path="create", $post_data, $callback = false);

			$user = ['user'=>$res->username, 'pass'=>$res->password, 'id'=>$res->created_id]; 
			$apiUsername = $res->username;
			$apiPassword = $res->password; 
			$usercredentials = json_encode($user); 
			update_field('field_58c78ce0ea6c0', $usercredentials, 'user_'.$this->currentUserId);
			return  "http://topchantv.net:3456/get.php?username=".$apiUsername."&password=".$apiPassword."&type=m3u&output=".$output; 

		}	
		if($params['action']=="edit" OR $_POST['UserName'] !== $apiUsername OR $apiPassword !== $_POST['UserPass']){
			$this->data['action'] = "inside edit" ;
			/*$userHistory = str_replace('&quot;', '"', get_field('field_58c78ce0ea6c0', 'user_'.$this->currentUserId)); 
			$userHistory = json_decode($userHistory, true);
			$apiUsername = isset($userHistory['user']) ? $userHistory['user'] : "";
			$apiPassword = isset($userHistory['pass']) ? $userHistory['pass'] : ""; */
			$newuser = $apiUsername; 
			$newpass = $apiPassword;
			if($_POST['UserName'] !== $apiUsername OR $apiPassword !== $_POST['UserPass']){
				$newuser = $_POST['UserName'];
				$newpass = $_POST['UserPass'];
				$user = ['user'=>$newuser, 'pass'=>$newpass, 'id'=>$userHistory['id']]; 
				$usercredentials = json_encode($user); 
				update_field('field_58c78ce0ea6c0', $usercredentials, 'user_'.$this->currentUserId);
			}

			$post_data = array(
			    'username' => $apiUsername,
			    'password' => $apiPassword,
			    'user_data' => array(
			        'max_connections' => 1,
			        'is_restreamer' => 0,
			        'exp_date' => $expire_date, 
			       'bouquet' => json_encode( $allChanIdes ),
			        'username'=>$newuser,
			        'password'=>$newpass
			     ) );
			$res = $this->request($path="edit", $post_data, $callback = false);
			return  "http://topchantv.net:3456/get.php?username=".$newuser."&password=".$newpass."&type=m3u&output=".$output; 
			
		}

		if($params['action']=="edit"){
			$this->data['action'] = "inside edit without update" ;
			/*$userHistory = str_replace('&quot;', '"', get_field('field_58c78ce0ea6c0', 'user_'.$this->currentUserId)); 
			$userHistory = json_decode($userHistory, true);
			$apiUsername = isset($userHistory['user']) ? $userHistory['user'] : "";
			$apiPassword = isset($userHistory['pass']) ? $userHistory['pass'] : ""; */
			$newuser = $apiUsername; 
			$newpass = $apiPassword;
			if($_POST['UserName'] !== $apiUsername OR $apiPassword !== $_POST['UserPass']){
				$newuser = $_POST['UserName'];
				$newpass = $_POST['UserPass'];
				$user = ['user'=>$newuser, 'pass'=>$newpass, 'id'=>$userHistory['id']]; 
				$usercredentials = json_encode($user); 
				update_field('field_58c78ce0ea6c0', $usercredentials, 'user_'.$this->currentUserId);
			}

			$post_data = array(
			    'username' => $apiUsername,
			    'password' => $apiPassword,
			    'user_data' => array(
			        'max_connections' => 1,
			        'is_restreamer' => 0,
			        'exp_date' => $expire_date, 
			       'bouquet' => json_encode( $allChanIdes ),
			       
			     ) );
			$res = $this->request($path="edit", $post_data, $callback = false);
			return  "http://topchantv.net:3456/get.php?username=".$newuser."&password=".$newpass."&type=m3u&output=".$output; 
			
		}
		return  "http://topchantv.net:3456/get.php?username=".$apiUsername."&password=".$apiPassword."&type=m3u&output=".$output;
	}


	public function resetUser($userHistory)
	{
		$apiUsername = isset($userHistory['user']) ? $userHistory['user'] : $_POST['UserName'];
		$apiPassword = isset($userHistory['pass']) ? $userHistory['pass'] : $_POST['UserPass']; 

		$post_data = array( 'username' => $apiUsername, 'password' => $apiPassword );
		$res = $this->actionInfo($post_data);

		if(empty($res['user_info'])){

			$expire_date = strtotime( "+1 month" );
			$post_data = array( 'user_data' => array(
				        'username' => $_POST['UserName'],
				        'password' => $_POST['UserPass'],
				        'max_connections' => 1,
				        'is_restreamer' => 0,
				        'exp_date' => $expire_date,
				        //'bouquet' => json_encode( $allChanIdes ),
				        //'stream_output_format'=>json_encode( array('1', '1','0') ) 
				        ) );
				//die("ok"); 
				$res = $this->request($path="create", $post_data, $callback = false);

				$user = ['user'=>$res->username, 'pass'=>$res->password, 'id'=>$res->created_id]; 
				$apiUsername = $res->username;
				$apiPassword = $res->password; 
				$usercredentials = json_encode($user); 
				update_field('field_58c78ce0ea6c0', $usercredentials, 'user_'.$this->currentUserId);
		}
	}


	public function processingOrderX()
	{
		$fake_id = 485; 
    	$chan_id = 478; 
    	$ord_id = 421;


		$this->orderHistory =  $this->getHistory(); 
		$oH = $this->orderHistory; 
		$OrderId = isset($_POST['OrderId']) ? $_POST['OrderId'] : '';
		$output = !empty($_POST['ViewType']) ? $_POST['ViewType'] : "ts"; 
		$chan = isset($_POST['chan']) ? $_POST['chan'] : ''; 
		$info =" -----------------"; 

		//if prev order found by order id change link and return link
		if(!empty($oH[$OrderId])){
			$info .= "Order Found: Download without update anything username=".$oH[$OrderId]['user']."&password=".$oH[$OrderId]['pass']."&type=m3u&output=".$output;

		}else{ 
			//if user prev order contain the same (100%) chanal 
			$currentChan = []; 
			foreach (explode(",", $chan.",") as $key => $v) {
				if(!empty($v))
				$currentChan[] = $v / $chan_id; 
			}	
			sort($currentChan); 
			$chanList = implode(",", $currentChan);
			$fullmatch = false; 
			$info .="else"; 
			foreach ($oH as $key => $v) {
				//
			 	if($oH[$key]['chan'] == $chanList){
			 		// expire date longen
			 		$info .="The same chanal was before EXPIRE DATE update with old password : username=".$oH[$key]['user']."&password=".$oH[$key]['pass'];
			 		$fullmatch = true; 
			 		break;
			 	}
			} 
			//create user
			if(!$fullmatch){
				//$oH[$OrderId] = ['']; 
				//$_POST['UserName'], 'password' => $_POST['UserPass']
				$info .="Create User with ".$_POST['UserName'] ." pass:".$_POST['UserPass']."&chanal".$chanList; 
			}			
		}

		return $info; 
	}

	public function actionEdit($post_data)
	{
		$opts = array( 'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query( $post_data ) ) );

		$context = stream_context_create( $opts );
		$api_result = json_decode( file_get_contents( $this->panel_url . "api.php?action=user&sub=edit", false, $context ) );
		return $api_result;
	}

	public function actionCreate($post_data)
	{
		$opts = array( 'http' => array(
		        'method' => 'POST',
		        'header' => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query( $post_data ) ) );

		$context = stream_context_create( $opts );
		$api_result = json_decode( file_get_contents( $this->panel_url . "api.php?action=user&sub=create", false, $context ) );
		return $api_result;
	}

	public function actionInfo($post_data=[])
	{
		
		$api_result = $this->request($path="info", $post_data, true);
		$this->data['args'] = $post_data;
		return $api_result;
	}

	public function request($path="create", $post_data=[], $callback = false)
	{
		$opts = array( 'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query( $post_data ) ) );

		$context = stream_context_create( $opts );
		if($callback===true){
			$api_result = json_decode( file_get_contents( $this->panel_url . "api.php?action=user&sub=".$path, false, $context ), true );	
		}else{
			$api_result = json_decode( file_get_contents( $this->panel_url . "api.php?action=user&sub=".$path, false, $context ));
		}
		
		return $api_result;
	}

	public function actionAdduser($value='')
	{
		
		$id = get_current_user_id();
		$data = [];
		$data['post'] = $_POST;


		$History = get_field('order_history', 'user_'.$id);
		$orderHistory = json_decode($History, true); 
		$orderId = $_POST['OrderId'];
		if(empty($orderHistory[$orderId])){
			$orderHistory[$orderId]	= ['user'=>'sdsf', 'pass'=>'sdfsd'];
		}
		$data['h'] = $orderHistory;



		$orderHistory = json_encode($orderHistory);
		update_field('order_history', $orderHistory , 'user_'.$id);
	}


	public  function cron()
	{
		$args =[ 
                'post_type'=>'user',
               	//'role__in'=>['customer']
            ];
            
    	$users = get_users( $args );
    	$today = time();

    	foreach ($users as $key => $u) {
    		$user_id = $u->data->ID;
    		$History = str_replace('&quot;', '"',get_field('field_58c78cc396a89', 'user_'.$user_id));
    		if(empty($History)){
    			continue;
    		}
			$oH = json_decode($History, true);	

			$userHistory = str_replace('&quot;', '"', get_field('field_58c78ce0ea6c0', 'user_'.$user_id)); 
			if(empty($userHistory)){
    			continue;
    		}
			$userHistory = json_decode($userHistory, true);
			$apiUsername = isset($userHistory['user']) ? $userHistory['user'] : "";
			$apiPassword = isset($userHistory['pass']) ? $userHistory['pass'] : ""; 

			$allChanIdes = []; 

			foreach ($oH as $key => $v) {
				if($v>$today){
					$allChanIdes[] = $key; 
				}else{
					unset($oH[$key]); 
				}
			}
			//echo "<pre>"; print_r($oH); echo "</pre>";	echo "<pre>"; print_r($userHistory); echo "</pre>";			echo "<hr/>";
			$lastVErsion = json_encode($oH); 
			update_field('field_58c78cc396a89',$lastVErsion, 'user_'.$user_id);	
			$expire_date = strtotime( "+1 month" );
			$post_data = array(
			    'username' => $apiUsername,
			    'password' => $apiPassword,
			    'user_data' => array(
			        'max_connections' => 1,
			        'is_restreamer' => 0,
			        'exp_date' => $expire_date, 
			       'bouquet' => json_encode( $allChanIdes ),
			        
			     ) );
			
			//$this->request("edit", $post_data, $callback = false);
			$opts = array( 'http' => array(
		        'method' => 'POST',
		        'header' => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query( $post_data ) ) );

				$context = stream_context_create( $opts );
				$api_result = json_decode( file_get_contents( "http://topchantv.net:3456/api.php?action=user&sub=edit", false, $context ), true );
			
    		
    	}
    	
    	die();
    }


}