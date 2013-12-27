<?php include '../../inc/config.php'; ?>
<?php include '../../inc/data.php'; ?>
<?php	
	$userQQ=getRequest("userQQ");
	$zpName=getRequest("zpName");
	$openUrl=prep_url(getRequest("openUrl"));
	$demoUrl=prep_url(getRequest("demoUrl"));
	$description=getRequest("description");
	$imgUrl=prep_url(getRequest("imgUrl"));
	$zpID=getRequest("zpID");
	$author=getRequest("author");

	$userID=0;

	//判断是否登录，获取登录信息
	// get user info
	//$xiami_works = mysql_query("SELECT id from xiami_user WHERE qq="); 
	if($zpID=="0")
	{
		$xiami_user=mysql_query("SELECT id from xiami_user where qq='".$userQQ."' ");
		if(!mysql_num_rows($xiami_user))
		{
			mysql_query("INSERT INTO xiami_user (qun_sort_id, openid, nickname, qq,is_open,addtime) VALUES (1,0,'".$author."','".$userQQ."',0,'".time()."')");
			$userID=mysql_insert_id();
		}
		else
		{
			$xiami_user = mysql_fetch_array($xiami_user);  
			$userID=$xiami_user['id'];
			
		}
		$sql="INSERT INTO xiami_works (name,userid,author, demourl, openurl,img,qq,description,addtime,status) VALUES ('".$zpName."',".$userID.", '".$author."', '".$demoUrl."','".$openUrl."','".$imgUrl."','".$userQQ."','".$description."','".time()."','1')";
		mysql_query($sql);		
		echo mysql_insert_id();
	}
	else
	{
		mysql_query("UPDATE xiami_works SET name = '".$zpName."',demourl='".$demoUrl."',openurl='".$openUrl."',img='".$imgUrl."',qq='".$userQQ."',description='".$description."' WHERE id =".$zpID);

		echo $zpID;
	}
?>