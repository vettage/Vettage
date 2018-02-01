<?php 
//if($_SERVER['HTTP_HOST']=='localhost')
//{
$host = 'vettagejournos.db.11230689.hostedresource.com';
$username = 'vettagejournos';
$password = 'V3ttag3s!';
$db_name =  'vettagejournos';
//}
/*else
{
$host = 'localhost';
$username = 'webapp_sachin';
$password = 'sznz=6{B#Sn}';
$db_name =  'webapp_vettage';
}*/

$con = mysql_connect($host,$username,$password);
$db  = mysql_select_db($db_name);

$monthly_amount = 0;$editor = array();$amt = array();
$subscription_price = array();$subscription_level = 0;$final_payment_amount = 0;
//monthly calculation query
$query = "SELECT AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) as percent ,contents.content_id ,editor
		  FROM contents LEFT JOIN content_ratings ON contents.content_id=content_ratings.content_id WHERE story_date Like '".date("Y-m")."%' AND status=1 GROUP BY contents.content_id ORDER BY AVG(importance)+AVG(credibility)+AVG(timeline)+AVG(appearance) DESC"; //

$result = mysql_query($query);$i=0;
///print_r($result);exit;
if(!$result) {
    die(mysql_error()); // TODO: better error handling
}
else
{
if(mysql_num_rows($result) > 0)
{
while($row = mysql_fetch_assoc($result))
	{		
		$editor[] = $row['editor'];
		/* subscription level and price details	*************************************************************/
			
			/* rating_by information */
				$rating_by_array = array();
				$query_rating = 'select rating_by from content_ratings where content_id='.$row['content_id'];
				$rating_details = mysql_query($query_rating);
				if(mysql_num_rows($rating_details) > 0)
				{
					while($rating_id = mysql_fetch_array($rating_details))
					{
						array_push($rating_by_array , $rating_id['rating_by']);
					}
				}
			
			/* end rating by information*/		
			
			$sub_pric = 0;$subscription_price[$row['editor']][$row['content_id']] = 0;
			if(!empty($rating_by_array))
			{			
				foreach($rating_by_array as $data_rating)	
				{
					$subscription_level_query   = 'select level from `members` where mem_id='.$data_rating;
					$sub_details 				=  mysql_query($subscription_level_query);
					if(!empty($sub_details))
					{
						while($sub_data = mysql_fetch_array($sub_details))
						{
							$subscription_level = $sub_data['level'];
						}
					}
					
					if($subscription_level == 5) { $sub_pric = (1250 /12) ;}
					elseif($subscription_level == 4) {$sub_pric = 9.99; }
					elseif($subscription_level == 3) {$sub_pric = 99;}	
					else {$sub_pric = 0; }
					$subscription_price[$row['editor']][$row['content_id']] +=$sub_pric ;			
				}			
			}
			
			if(in_array($row['editor'],$editor)) 
			{
				$per = round(($row['percent']*100)/40,2);
				$per = $per - 10;
				if(!empty($amt[$row['editor']])) $amt[$row['editor']] += $per;
				else $amt[$row['editor']] = $per;
			}
			else $amt[$row['editor']] = 0;
			
			
			$final_payment_amount = (((float)($subscription_price[$row['editor']][$row['content_id']])) * (($amt[$row['editor']]))) / 100;		
			 $details = mysql_query("select * from editor_pricing where editor =".$row['editor']." and month = '".date('Y-m')."' and content_id =".$row['content_id']);
			if(mysql_num_rows($details))
			{
				$query  = "update editor_pricing set price =".$final_payment_amount." where editor =".$row['editor']." and month = '".date('Y-m')."' and content_id=".$row['content_id'];
			}
			else
			{		
				$query  = 'insert into editor_pricing (editor,price,month,content_id) values('.$row['editor'].','.$final_payment_amount.',"'.date('Y-m').'","'.$row['content_id'].'")';
			}
			
			$result1 = mysql_query($query,$con);
			if(!$result1) echo "ERROR IN QUERY";
				
	}
}
}
/*if(!empty($amt))
{
	$db  = mysql_select_db('vettage');
	foreach($amt as $key=>$value)
	{		
		$final_payment_amount = (((float)($subscription_price[$key])) * (($value))) / 100;		
		$details = mysql_query("select * from editor_pricing where editor =".$key." and month = '".date('Y-m')."'");
		if(mysql_num_rows($details))
		{
			$query  = "update editor_pricing set price =".$final_payment_amount." where editor =".$key." and month = '".date('Y-m')."'";
		}
		else
		{		
			$query  = 'insert into editor_pricing (editor,price,month) values('.$key.','.$final_payment_amount.',"'.date('Y-m').'")';
		}
		
		$result = mysql_query($query,$con);
		if(!$result) echo "ERROR IN QUERY";
	}
}
*/
?>