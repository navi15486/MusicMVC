<?php 

class shoppingController extends Controller
{
	public function index()
	{
		session_start();
	    $title = "Shopping Cart";
		$user = $this->model('userModel');
		$user = unserialize($_SESSION['user']);
		$profile_id = $user->getProfile()->getProfileId();
		$cart = $this->model('cartModel'); 

		//an Array return by the method
		$shopping_cart = $cart->getCart($profile_id);
		$audioArray = []; 
		$audioMod = $this->model('audioModel');
		if (isset($_POST['remove']))
		{
			$cartId = $_POST['cartId'];
			echo "Cart Id is " . $cartId;
			$cart->deleteCart($cartId); 
			return    header('Location: http://localhost/music/public/shopping/');
		}

		foreach ($shopping_cart as $carts)
		{	
			$audioTemp = $this->model('audioModel');
			$audioTemp = $audioMod->getCartAudios($carts->getAudioId());
			$audioTemp->setCartId($carts->getLineId());//setCartId($cartId)
			$audioArray [] = $audioTemp;
		}

		if (isset($_POST['checkout']))
		{
			$today = getdate();
			$order_date = $today['mon'] . "-" . $today['mday'] . "-" . $today['year'];
			$order_methpmt = "paypal"; 
			//$audio_ID_array = $_POST['audioID'];  
			$order = $this->model('ordersModel'); 
			foreach ($shopping_cart as $value) 
			{ 
				$audio_id = $value->getAudioId();
				$order_id = $order->add($profile_id, $order_date, $order_methpmt);
				$this->completeOrder($order_id, $audio_id);
			}
			return $this->view('user/payment',[ 'title' => "Payment" ]);
		}
		return $this->view('user/shopping', [ 'title' => $title, 'audioArray'=>$audioArray , 'shopping_cart' =>$shopping_cart , 'profile_id' =>$profile_id]);
	}

	public function completeOrder($order_id, $audio_id)
	{
		$order_line = $this->model('orderLineModel');
		$audio = $this->model('audioModel');
		$audio_info = $audio->getCartAudios($audio_id); 
		$audioName = $audio_info->getAudioName();
		$audioGenre = $audio_info->getAudioGenre();
		$audioIsSong = $audio_info->getIfSong();
		$audioIsInstrumental = $audio_info->getIfInstrumental();
		$audioType = $audio_info->getAudioType();
		$audioPrice = $audio_info->getAudioPrice(); 
		$order_line->add($order_id, $audioName, $audioGenre, $audioIsSong, $audioIsInstrumental, $audioType, $audioPrice);
	}


	public function getCarts()
	{
		$cart = $this->model('cartModel');  
		
		if (isset($_POST['delete']))
		{
			$cart_id = $_POST['lineId'];
			$cart->deleteCart($cart_id);	 
		}

		if (isset($_POST['update']))
		{
			$cart_id = $_POST['lineId'];
			$profile_id = $_POST['profileId'];
			$audio_id = $_POST['audioId'];
			$cart->updateCart($cart_id , $profile_id , $audio_id );	 
		}
		$shopping_cart = $cart->getCarts();
		return $this->view('admin/cartsAllItems', [  'shopping_cart' =>$shopping_cart  ]);
	}
}