<?php
 
    $lang = $_GET['lang'];
    
    if($lang=='en')
    {
       $value =  $this->db->get('term_condition')->row_array();
       $value = $value['term_condition_en'];
    }
    else
    {
       $value =  $this->db->get('term_condition')->row_array();
       $value = $value['term_condition_ar'];
    }
    //print_r($value);
?>
<!DOCTYPE html>
<html>
<head>
<title>Term Conditions</title>
</head>
<body>

<!--<h2 style="text-align:center;">Term Conditions</h2>-->
<p><?=@$value?></p>

</body>
</html>