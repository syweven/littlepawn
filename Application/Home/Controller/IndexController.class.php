<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html; charset=utf8");
class IndexController extends Controller {
    public function index(){
    	import('ORG.Net.IpLocation');
    	$Ip = new \Org\Net\IpLocation('UTFWry.dat');
    	$location = $Ip->getlocation();
    	$region=$location['country'];
    	$region=substr($region, 0,9);
    	$Province=M("Province");
    	if($Province->where("name='$region'")->find()<1){
    		$region="江苏省";
    	}
    	$this->assign("location",$region);
    	$province=$Province->select();
    	$this->assign("province",$province);
    	$City=M("City");
    	$p=$Province->where("name='$region'")->field("code")->select();
    	$provincecode=$p['0']['code'];
    	$city=$City->where("provincecode='$provincecode'")->select();
    	$Area=M("Area");
    	$citycode=$city['0']['code'];
    	$county=$Area->where("citycode='$citycode'")->select();
    	$this->assign("city",$city);
    	$this->assign("county",$county);
    	
    	$pagesize=2;
    	$house=M('House');
    	$list=$house->order('date desc')->select();
    	$rowcount=count($list);
    	if(($rowcount-1)%2!=0){
    		$pagecount=($rowcount-2)/$pagesize+1;
    	}else{
    		$pagecount=($rowcount-1)/$pagesize+1;
    	}
    	$this->assign("rowcount",$rowcount);
    	$this->assign("pagecount",$pagecount);
    	$this->assign("pagesize",$pagesize);
    	if(isset($_GET['pagenow'])){
    		$pagenow=$_GET['pagenow'];
    		$limit=($pagenow-1)*$pagesize;
    		if($pagenow>1){
	    		$data=$house->order('date desc')->limit($limit,$pagesize)->select();
	    		$this->assign("data",$data);
	    		$this->display();
    		}else {
    			$data=$house->order('date desc')->limit($pagesize)->select();
    			$this->assign("data",$data);
    			$this->display();
    		}
    	}else{
    		$data=$house->order('date desc')->limit($pagesize)->select();  		
	    	$this->assign("data",$data);	    	
			$this->display();
    	}
    }   
        
    public function city(){
    	$provincename=$_POST['provincename'];
    	$Province=M("Province");
    	$code=$Province->field("code")->where("name='$provincename'")->select();
    	$provincecode=$code['0']['code'];
    	$City=M("City");
    	$c=$City->where("provincecode='$provincecode'")->select();
    	$data=array();
    	for($i=0;$i<count($c);$i++){
    		$data['city'][]=$c[$i]['name'];
    	}
    	$data['province']=$provincename;
    	$this->ajaxReturn($data);
    }
    
    public function area(){
    	$cityname=$_POST['cityname'];
    	$City=M("City");
    	$code=$City->field("code")->where("name='$cityname'")->select();
    	$citycode=$code['0']['code'];
    	$Area=M("Area");
    	$a=$Area->where("citycode='$citycode'")->select();
    	$data=array();
    	for($i=0;$i<count($a);$i++){
    		$data['area'][]=$a[$i]['name'];
    	}
    	$data['city']=$cityname;
    	$this->ajaxReturn($data);
    }
    
    public function wantedindex(){
    	import('ORG.Net.IpLocation');
    	$Ip = new \Org\Net\IpLocation('UTFWry.dat');
    	$location = $Ip->getlocation();
    	$region=$location['country'];
    	$region=substr($region, 0,9);
    	$Province=M("Province");
    	if($Province->where("name='$region'")->find()<1){
    		$region="江苏省";
    	}
    	$this->assign("location",$region);
    	$province=$Province->select();
    	$this->assign("province",$province);
    	$City=M("City");
    	$p=$Province->where("name='$region'")->field("code")->select();
    	$provincecode=$p['0']['code'];
    	$city=$City->where("provincecode='$provincecode'")->select();
    	$Area=M("Area");
    	$citycode=$city['0']['code'];
    	$county=$Area->where("citycode='$citycode'")->select();
    	$this->assign("city",$city);
    	$this->assign("county",$county);
    	
    	$pagesize=2;
    	$house=M('Wantedhouse');
    	$list=$house->order('date desc')->select();
    	$rowcount=count($list);
    	if(($rowcount-1)%2!=0){
    		$pagecount=($rowcount-2)/$pagesize+1;
    	}else{
    		$pagecount=($rowcount-1)/$pagesize+1;
    	}
    	$this->assign("rowcount",$rowcount);
    	$this->assign("pagecount",$pagecount);
    	$this->assign("pagesize",$pagesize);
    	if(isset($_GET['pagenow'])){
    		$pagenow=$_GET['pagenow'];
    		$limit=($pagenow-1)*$pagesize;
    		if($pagenow>1){
    			$data=$house->order('date desc')->limit($limit,$pagesize)->select();
    			$this->assign("data",$data);
    			$this->display();
    		}else {
    			$data=$house->order('date desc')->limit($pagesize)->select();
    			$this->assign("data",$data);
    			$this->display();
    		}
    	}else{
    		$data=$house->order('date desc')->limit($pagesize)->select();
    		$this->assign("data",$data);
    		$this->display();
    	}
    }
    
    public function login(){
    	$this->display();
    }
    
    public function main(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
			$this->assign('name',$_SESSION['user']["name"]);
			
			import('ORG.Net.IpLocation');
	    	$Ip = new \Org\Net\IpLocation('UTFWry.dat');
	    	$location = $Ip->getlocation();
	    	$region=$location['country'];
	    	$region=substr($region, 0,9);
	    	$Province=M("Province");
	    	if($Province->where("name='$region'")->find()<1){
	    		$region="江苏省";
	    	}
	    	$this->assign("location",$region);
	    	$province=$Province->select();
	    	$this->assign("province",$province);
	    	$City=M("City");
	    	$p=$Province->where("name='$region'")->field("code")->select();
	    	$provincecode=$p['0']['code'];
	    	$city=$City->where("provincecode='$provincecode'")->select();
	    	$Area=M("Area");
	    	$citycode=$city['0']['code'];
	    	$county=$Area->where("citycode='$citycode'")->select();
	    	$this->assign("city",$city);
	    	$this->assign("county",$county);
			
	    	$pagesize=2;
	    	$house=M('House');
	    	$list=$house->order('date desc')->select();
	    	$rowcount=count($list);
	    	if(($rowcount-1)%2!=0){
	    		$pagecount=($rowcount-2)/$pagesize+1;
	    	}else{
	    		$pagecount=($rowcount-1)/$pagesize+1;
	    	}
	    	$this->assign("rowcount",$rowcount);
	    	$this->assign("pagecount",$pagecount);
	    	$this->assign("pagesize",$pagesize);
	    	if(isset($_GET['pagenow'])){
	    		$pagenow=$_GET['pagenow'];
	    		$limit=($pagenow-1)*$pagesize;
	    		if($pagenow>1){
		    		$data=$house->order('date desc')->limit($limit,$pagesize)->select();
		    		$this->assign("data",$data);
		    		$this->display();
	    		}else {
	    			$data=$house->order('date desc')->limit($pagesize)->select();
	    			$this->assign("data",$data);
	    			$this->display();
	    		}
	    	}else{
	    		$data=$house->order('date desc')->limit($pagesize)->select();  		
		    	$this->assign("data",$data);	    	
				$this->display();
	    	}
	    	}else{
	    		$this->redirect("index");
	    	}
    }
    
    public function wantedmain(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		
    		import('ORG.Net.IpLocation');
	    	$Ip = new \Org\Net\IpLocation('UTFWry.dat');
	    	$location = $Ip->getlocation();
	    	$region=$location['country'];
	    	$region=substr($region, 0,9);
	    	$Province=M("Province");
	    	if($Province->where("name='$region'")->find()<1){
	    		$region="江苏省";
	    	}
	    	$this->assign("location",$region);
	    	$province=$Province->select();
	    	$this->assign("province",$province);
	    	$City=M("City");
	    	$p=$Province->where("name='$region'")->field("code")->select();
	    	$provincecode=$p['0']['code'];
	    	$city=$City->where("provincecode='$provincecode'")->select();
	    	$Area=M("Area");
	    	$citycode=$city['0']['code'];
	    	$county=$Area->where("citycode='$citycode'")->select();
	    	$this->assign("city",$city);
	    	$this->assign("county",$county);
    		
    		$pagesize=2;
    		$house=M('Wantedhouse');
    		$list=$house->order('date desc')->select();
    		$rowcount=count($list);
    		if(($rowcount-1)%2!=0){
    			$pagecount=($rowcount-2)/$pagesize+1;
    		}else{
    			$pagecount=($rowcount-1)/$pagesize+1;
    		}
    		$this->assign("rowcount",$rowcount);
    		$this->assign("pagecount",$pagecount);
    		$this->assign("pagesize",$pagesize);
    		if(isset($_GET['pagenow'])){
    			$pagenow=$_GET['pagenow'];
    			$limit=($pagenow-1)*$pagesize;
    			if($pagenow>1){
    				$data=$house->order('date desc')->limit($limit,$pagesize)->select();
    				$this->assign("data",$data);
    				$this->display();
    			}else {
    				$data=$house->order('date desc')->limit($pagesize)->select();
    				$this->assign("data",$data);
    				$this->display();
    			}
    		}else{
    			$data=$house->order('date desc')->limit($pagesize)->select();
    			$this->assign("data",$data);
    			$this->display();
    		}
    	}else{
    		$this->redirect("index");
    	}
    }
    
    public function checklogin(){
    	if(!empty($_POST['email'])&&!empty($_POST['password'])){
    		$User=M("User");
    		$email=trim($_POST['email']);
    		$password=md5($_POST['password']);
    		if($User->where("email='$email'"." AND"." password='$password'")->find()>0){
    			$data=$User->where("email='$email'")->field()->select();
    			session("user",array(
    				"id"=>$data[0]['id'],
    				"name"=>$data[0]['name'],
    				"email"=>$data[0]['email'],
    				"phone"=>$data[0]['phone'],
    				"address"=>array(
 		   				"province"=>$data[0]['province'],
    					"city"=>$data[0]["city"],
    					"area"=>$data[0]['area'],			
    					),
    			));
    			$this->redirect("main");
    		}else{
    			$this->error("邮箱或密码错误","login");
    		}
    	}else{
    		$this->error("登录失败","login");
    	}
    }
    
    public function register(){
    	$this->display();
    }
    
    public function insert(){
    	header('Content-Type:text/html; charset=utf-8');
    	$User=M("User");
    	if(!empty($_POST["username"])&&!empty($_POST['email'])&&!empty($_POST['password'])){
    		$data["id"]=$_POST["id"];
    		$data["name"]=$_POST["username"];
	    	$data["email"]=$_POST["email"];
	    	$data["password"]=md5($_POST["password"]);
    	}
    	$data["date"]=date("Y-m-d H:i:s");
    	if($User->add($data)){
    		$this->redirect ('login');
    	}else{
    		$this->assign("errorinfo",$User->getError ());
    		$this->display("register");
    	}
    }
    
    public function loginout(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		session_unset($_SESSION['user']);
    		$this->redirect("index");
    	}
    }
    
    public function userinfo(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->assign('email',$_SESSION['user']["email"]);
    		if(!$_SESSION['user']["phone"]){
    			$this->assign('phone',"未填写");
    		}else{
    			$this->assign('phone',$_SESSION['user']["phone"]);
    		}
    		if(!$_SESSION['user']['sex']){
    			$this->assign('sex',"男");
    		}else{
    			$this->assign('sex',$_SESSION['user']['sex']);
    		}
    		if(!$_SESSION['user']["address"]){
    			$this->assign('province',"");
    			$this->assign('city',"");
    			$this->assign('area',"");
    		}else{
    			$this->assign('province',$_SESSION['user']['address']["province"]);
    			$this->assign('city',$_SESSION['user']['address']['city']);
    			$this->assign('area',$_SESSION['user']['address']['area']);
    		}
    		$this->display();
    	}
    }
    
    public function edituserinfo(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->assign('email',$_SESSION['user']["email"]);
    		if(!$_SESSION['user']["phone"]){
    			$this->assign('phone',"未填写");
    		}else{
    			$this->assign('phone',$_SESSION['user']["phone"]);
    		}
    		if(!$_SESSION['user']['sex']){
    			$this->assign('sex',"男");
    		}else{
    			$this->assign('sex',$_SESSION['user']['sex']);
    		}
    		if(empty($_SESSION['user']["address"])){
    			$this->assign('province',$_SESSION['user']['address']['province']);
    			$this->assign('city',$_SESSION['user']['address']['city']);
    			$this->assign('area',$_SESSION['user']['address']['area']);
    		}else{
    			import('ORG.Net.IpLocation');
    			$Ip = new \Org\Net\IpLocation('UTFWry.dat');
    			$location = $Ip->getlocation();
    			$region=$location['country'];
    			$region=substr($region,0,9);
    			$Province=M("Province");
    			if($Province->where("name='$region'")->find()<1){
    				$region="江苏省";
    			}
    			$province=$Province->where("name='$region'")->select();
    			$p=$Province->select();
    			$this->assign("province",$region);
    			$this->assign("dprovince",$p);
    			$City=M("City");
    			$provincecode=$province['0']['code'];
    			$city=$City->where("provincecode='$provincecode'")->select();
    			$Area=M("Area");
    			$citycode=$city['0']['code'];
    			$county=$Area->where("citycode='$citycode'")->select();
    			$this->assign("city",$city['0']['name']);
    			$this->assign("area",$county['0']['name']);
    			$this->assign("dcity",$city);
    			$this->assign("county",$county);
    		}
    		$this->display();
    	}
    }
    
    public function houserentinfo(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$name=$_SESSION['user']['name'];
	    	$pagesize=2;
	    	$house=M('House');
	    	$list=$house->order('date')->where("houseowner='$name'")->select();
	    	$rowcount=count($list);
	    	if(($rowcount-1)%2!=0){
	    		$pagecount=($rowcount-2)/$pagesize+1;
	    	}else{
	    		$pagecount=($rowcount-1)/$pagesize+1;
	    	}
	    	$this->assign("rowcount",$rowcount);
	    	$this->assign("pagecount",$pagecount);
	    	$this->assign("pagesize",$pagesize);
	    	if(isset($_GET['pagenow'])){
	    		$pagenow=$_GET['pagenow'];
	    		$limit=($pagenow-1)*$pagesize;
	    		if($pagenow>1){
		    		$data=$house->order('date desc')->where("houseowner='$name'")->limit($limit,$pagesize)->select();
		    		$this->assign("data",$data);
		    		$this->display();
	    		}else {
	    			$data=$house->order('date desc')->where("houseowner='$name'")->limit($pagesize)->select();
	    			$this->assign("data",$data);
	    			$this->display();
	    		}
	    	}else{
	    		$data=$house->order('date desc')->where("houseowner='$name'")->limit($pagesize)->select();  		
		    	$this->assign("data",$data);	    	
				$this->display();
	    	}
    	}
    }
    
    public function wantedinfo(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$name=$_SESSION['user']['name'];
    		$pagesize=2;
    		$house=M('Wantedhouse');
    		$list=$house->order('date')->where("publisher='$name'")->select();
    		$rowcount=count($list);
    		if(($rowcount-1)%2!=0){
    			$pagecount=($rowcount-2)/$pagesize+1;
    		}else{
    			$pagecount=($rowcount-1)/$pagesize+1;
    		}
    		$this->assign("rowcount",$rowcount);
    		$this->assign("pagecount",$pagecount);
    		$this->assign("pagesize",$pagesize);
    		if(isset($_GET['pagenow'])){
    			$pagenow=$_GET['pagenow'];
    			$limit=($pagenow-1)*$pagesize;
    			if($pagenow>1){
    				$data=$house->order('date desc')->where("publisher='$name'")->limit($limit,$pagesize)->select();
    				$this->assign("data",$data);
    				$this->display();
    			}else {
    				$data=$house->order('date desc')->where("publisher='$name'")->limit($pagesize)->select();
    				$this->assign("data",$data);
    				$this->display();
    			}
    		}else{
    			$data=$house->order('date desc')->where("publisher='$name'")->limit($pagesize)->select();
    			$this->assign("data",$data);
    			$this->display();
    		}
    	}
    }
    
    public function edithouserentinfo(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$name=$_SESSION['user']['name'];
	    	$pagesize=2;
	    	$house=M('House');
	    	$list=$house->order('date desc')->where("houseowner='$name'")->select();
	    	$rowcount=count($list);
	    	if(($rowcount-1)%2!=0){
	    		$pagecount=($rowcount-2)/$pagesize+1;
	    	}else{
	    		$pagecount=($rowcount-1)/$pagesize+1;
	    	}
	    	$this->assign("rowcount",$rowcount);
	    	$this->assign("pagecount",$pagecount);
	    	$this->assign("pagesize",$pagesize);
	    	if(isset($_GET['pagenow'])){
	    		$pagenow=$_GET['pagenow'];
	    		$limit=($pagenow-1)*$pagesize;
	    		if($pagenow>1){
		    		$data=$house->order('date desc')->where("houseowner='$name'")->limit($limit,$pagesize)->select();
		    		$this->assign("data",$data);
		    		$this->display();
	    		}else {
	    			$data=$house->order('date desc')->where("houseowner='$name'")->limit($pagesize)->select();
	    			$this->assign("data",$data);
	    			$this->display();
	    		}
	    	}else{
	    		$data=$house->order('date desc')->where("houseowner='$name'")->limit($pagesize)->select();  		
		    	$this->assign("data",$data);	    	
				$this->display();
	    	}
    	}
    }
    
    public function editwantedinfo(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$name=$_SESSION['user']['name'];
    		$pagesize=2;
    		$house=M('Wantedhouse');
    		$list=$house->order('date desc')->where("publisher='$name'")->select();
    		$rowcount=count($list);
    		if(($rowcount-1)%2!=0){
    			$pagecount=($rowcount-2)/$pagesize+1;
    		}else{
    			$pagecount=($rowcount-1)/$pagesize+1;
    		}
    		$this->assign("rowcount",$rowcount);
    		$this->assign("pagecount",$pagecount);
    		$this->assign("pagesize",$pagesize);
    		if(isset($_GET['pagenow'])){
    			$pagenow=$_GET['pagenow'];
    			$limit=($pagenow-1)*$pagesize;
    			if($pagenow>1){
    				$data=$house->order('date desc')->where("publisher='$name'")->limit($limit,$pagesize)->select();
    				$this->assign("data",$data);
    				$this->display();
    			}else {
    				$data=$house->order('date desc')->where("publisher='$name'")->limit($pagesize)->select();
    				$this->assign("data",$data);
    				$this->display();
    			}
    		}else{
    			$data=$house->order('date desc')->where("publisher='$name'")->limit($pagesize)->select();
    			$this->assign("data",$data);
    			$this->display();
    		}
    	}
    }
    
    public function publish1(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function publish2_1(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function publish2_2(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function checkpublish2_1(){
    	if(!empty($_POST['address'])&&!empty($_POST['rent'])&&!empty($_POST['title'])&&!empty($_POST['renttype'])&&!empty($_POST['floor'])&&!empty($_POST['countfloor'])&&!empty($_POST['rent'])&&!empty($_POST['bedroom'])&&!empty($_POST['area'])){
    		$house=M("House");
    		
    		$data["id"]="";
    		$data['renttype']=$_POST['renttype'];
    		$data['address']=$_POST['address'];
    		$data['bedroom']=$_POST['bedroom'];
    		$data['livingroom']=$_POST['livingroom'];
    		$data['toilet']=$_POST['toilet'];
    		$data['area']=$_POST['area'];
    		$data['floor']=$_POST['floor'];
    		$data['countfloor']=$_POST['countfloor'];
    		$data['rent']=$_POST['rent'];
    		$data['title']=$_POST['title'];
    		$data['context']=$_POST['context'];
    		$data['name']=$_POST['name'];
    		$data['phone']=$_POST['phone'];
    		$data['houseowner']=$_SESSION['user']['name'];
    		$data['date']=date("Y-m-d H:i:s");
    		
    		if($house->add($data)){
    			echo $this->success("插入成功","publish3");
    		}else{
    			echo $this->error("插入失败","publish2_1");
    		}
    	}else{
    		echo $this->error("插入失败","publish2_1");
    	}
    	$this->redirect("publish3");
    }
    
    public function checkpublish2_2(){
    	if(!empty($_POST['title'])&&!empty($_POST['rent'])&&!empty($_POST['province'])&&!empty($_POST['type'])&&!empty($_POST['area'])&&!empty($_POST['rent'])){
    		$house=M("Wantedhouse");
    
    		$data["id"]="";
    		$data['type']=$_POST['type'];
    		$data['area']=$_POST['area'];
    		$data['province']=$_POST['province'];
    		$data['city']=$_POST['city'];
    		$data['rent']=$_POST['rent'];
    		$data['title']=$_POST['title'];
    		$data['context']=$_POST['context'];
    		$data['name']=$_POST['name'];
    		$data['phone']=$_POST['phone'];
    		$data['publisher']=$_SESSION['user']['name'];
    		$data['date']=date("Y-m-d H:i:s");
    
    		if($house->add($data)){
    			echo $this->success("插入成功","publish3");
    		}else{
    			echo $this->error("插入失败","publish2_2");
    		}
    	}else{
    		echo $this->error("插入失败","publish2_2");
    	}
    	 
    	 
    	 
    	$this->redirect("publish3");
    }
    
	public function publish3(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function update_userinfo(){
    	$user=M('User');
    	$user->sex=$_POST['sex'];
    	$user->province=$_POST['province'];
    	$user->city=$_POST['city'];
    	$user->area=$_POST['area'];
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
	    	if(empty($_POST['name'])){
	    		$name=$_SESSION['user']['name'];
	    		if($user->where("name='$name'")->save()){
	    			$_SESSION['user']['sex']=$_POST['sex'];
	    			$_SESSION['user']['address']['province']=$_POST['province'];
	    			$_SESSION['user']['address']['city']=$_POST['city'];
	    			$_SESSION['user']['address']['area']=$_POST['area'];
	    			$this->redirect("userinfo");
	    		}else{
	    			echo $this->error("更新失败","userinfo");
	    		}
	    	}else{
	    		$user->name=$_POST['name'];
	    		$id=$_SESSION['user']['id'];
	    		if($user->where("id='$id'")->save()){
	    			$_SESSION['user']['name']=$_POST['name'];
	    			$_SESSION['user']['sex']=$_POST['sex'];
	    			$_SESSION['user']['address']['province']=$_POST['province'];
	    			$_SESSION['user']['address']['city']=$_POST['city'];
	    			$_SESSION['user']['address']['area']=$_POST['area'];
	    			$this->redirect("userinfo");
	    		}else{
	    			echo $this->error("更新失败","userinfo");
	    		}
	    	}
    	}
    }
    
    public function editpassword(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function editemail(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function editphone(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$this->display();
    	}
    }
    
    public function delhouserentinfo(){
    	$this->redirect("houserentinfo");
    }
    
    public function savehouserentinfo(){
    	$this->redirect("houserentinfo");
    }
    
    public function torentinfobefore(){
    	if(isset($_GET['id'])){
    		$id=$_GET['id'];
	    	$house=M('House');
	    	$data=$house->where("id='$id'")->select();
	    	$this->assign("data",$data);
    		$this->display("rentinfobefore");
    	}
    }
    
    public function towantedinfobefore(){
    	if(isset($_GET['id'])){
    		$id=$_GET['id'];
    		$house=M('Wantedhouse');
    		$data=$house->where("id='$id'")->select();
    		$this->assign("data",$data);
    		$this->display("wantedinfobefore");
    	}
    }
    
    public function torentinfoafter(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$house=M("House");
    		if(isset($_GET['id'])){
    			$id=$_GET['id'];
    			$data=$house->where("id='$id'")->select();
    			$this->assign("data",$data);
    			$this->display("rentinfoafter");
    		}
    	}
    }
    
    public function towantedinfoafter(){
    	if(isset($_SESSION['user'])||!$_SESSION['user']){
    		$this->assign('name',$_SESSION['user']["name"]);
    		$house=M("Wantedhouse");
    		if(isset($_GET['id'])){
    			$id=$_GET['id'];
    			$data=$house->where("id='$id'")->select();
    			$this->assign("data",$data);
    			$this->display("wantedinfoafter");
    		}
    	}
    }
    
    public function findpwd1(){
    	$this->display();
    }
    
    public function checkphone(){
    	if(IS_POST){
    		if(!empty($_POST['password'])&&!empty($_POST['phone'])){
    			$user=M("User");
    			$pwd=md5($_POST['password']);
    			$name=$_SESSION['user']['name'];
    			if($user->where("password='$pwd'")->find()>0){
    				$data['phone']=$_POST['phone'];
    				if($user->where("name='$name'")->save($data)){
    					$_SESSION['user']['phone']=$_POST['phone'];
    					$this->redirect("userinfo");
    				}else {
    					$this->error("修改失败","userinfo");
    				}
    			}else{
    				$this->error("修改失败","userinfo");
    			}
    		}else{
    			$this->error("修改失败","userinfo");
    		}
    	}else {
    		$this->error("修改失败","userinfo");
    	}
    }
}

