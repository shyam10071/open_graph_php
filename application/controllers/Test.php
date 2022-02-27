<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";

use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpClient\Psr18Client;
class Test extends CI_Controller {

	
	public function __construct(){

		parent::__construct();
		$this->load->model('Mdl_test');

	}

	function dashboard(){
		$dataget=$this->Mdl_test->dataget();
		$data['data']=$dataget;
		$this->load->view('dashboard',$data);
		
	}	
	function getCard(){
		
		$client = new Psr18Client(new NativeHttpClient([ "headers" => [ "User-Agent" => "facebookexternalhit/1.1" ] ]));
		$crawler = new Fusonic\OpenGraph\Consumer($client, $client);
		$object = $crawler->loadUrl(''.$_POST['urlData'].'');

		foreach($object as $key=>$pair){
			
			if($key=='description'){
				$descriptionText=$pair;
			}
			if($key=='title'){
				$titleText=$pair;
			}
			if($key=='images'){
				$pair=$pair[0];
				foreach($pair as $key1=>$pair1){
					if($key1=='url'){
						$imageUrl=$pair1;
					}
				}
			}
		}
		
		$data['description']=$descriptionText;
		$data['title']=$titleText;
		$data['imageUrl']=$imageUrl;

		echo json_encode($data);

	}

	function dbInsert(){
		$titleText=$_POST['title'];
		$descriptionText=$_POST['description'];
		$imageUrl=$_POST['image'];

		$Insertdata=$this->Mdl_test->insertData($descriptionText,$titleText,$imageUrl);
		$dataget=$this->Mdl_test->dataget();

		$str = '';
	  
		foreach($dataget as $data){
			 $str .= '<tr>
				<td>' .$data->s_id.'</td>
				<td><img src='.$data->image_url.' alt="" height=30 width=30></img></td>
				<td>' .$data->title.'</td>
				<td>' .$data->description.'</td>
				</tr>';
		}		
		echo json_encode($str);
	}
}
