<?php
 
    $lang = $_GET['lang'];
    
    if($lang=='en')
    {
       $value =  $this->db->get('about_us')->row_array();
       $value = $value['about_us_en'];
    }
    else
    {
       $value =  $this->db->get('about_us')->row_array();
       $value = $value['about_us_ar'];
    }
    //print_r($value);
?>
<!DOCTYPE html>
<html>
<head>
<title>About Us</title>
</head>
<body>

<!--<h2 style="text-align:center;">Term Conditions</h2>-->
<p><?=@$value?></p>

</body>
</html>