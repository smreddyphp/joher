<?php
 
    $lang = $_GET['lang'];
    
    if($lang=='en')
    {
       $value =  $this->db->get('privacy_policy')->row_array();
       $value = $value['privacy_policy_en'];
    }
    else
    {
       $value =  $this->db->get('privacy_policy')->row_array();
       $value = $value['privacy_policy_ar'];
    }
    //print_r($value);
?>
<!DOCTYPE html>
<html>
<head>
<title>Privacy Policy</title>
</head>
<body>

<!--<h2 style="text-align:center;">Term Conditions</h2>-->
<p><?=@$value?></p>

</body>
</html>