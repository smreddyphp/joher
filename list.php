<!DOCTYPE html>
<html lang="en">
<head>
  <title>Joher Services List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid" style="background:  beige;">
  <h2 style = "background: #c62928;color:white">Joher Service Table List</h2>
   
  <table class="table">
    <thead>
      <tr>
        <th>S.No.</th>  
        <th>Date</th>
        <th>Service Name</th>
        <th>Method</th>
        <th>URL</th>
        <th>Paramiter</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>16-07-2018</td>
        <td>Registar</td>
        <td>Post</td>
        <td>http://volive.in/joher/api/Service/registar</td>
        <td>API-KEY=98745612,mobile,country_code,email,name,password,device_type,device_token,lang=EN</td>
      </tr>
      
      <tr>
        <td>2</td>
        <td>16-07-2018</td>
        <td>Login</td>
        <td>Post</td>
        <td>http://volive.in/joher/api/Service/login</td>
        <td>API-KEY=98745612,email,password,device_type,device_token,lang=EN</td>
      </tr>
      
      <tr>
        <td>3</td>
        <td>16-07-2018</td>
        <td>Country Code</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/getCountryCode/?API-KEY=98745612</td>
        <td>http://volive.in/joher/api/Service/getCountryCode/?API-KEY=98745612</td>
      </tr>
      
      <tr>
        <td>4</td>
        <td>17-07-2018</td>
        <td>Otp Varification</td>
        <td>POST</td>
        <td>http://volive.in/joher/api/Service/otpVarification</td>
        <td>API-KEY=98745612,lang=en,mobile,otp</td>
      </tr>
      
      <tr>
        <td>5</td>
        <td>17-07-2018</td>
        <td>OTP Generation</td>
        <td>POST</td>
        <td>http://volive.in/joher/api/Service/otpGeneration</td>
        <td>API-KEY=98745612,lang=en,mobile</td>
      </tr>
      
       <tr>
        <td>6</td>
        <td>17-07-2018</td>
        <td>GET Category</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_categoryDetails/?API-KEY=98745612&lang=en</td>
        <td>http://volive.in/joher/api/Service/get_categoryDetails/?API-KEY=98745612&lang=en</td>
      </tr>
      
       <tr>
        <td>7</td>
        <td>20-07-2018</td>
        <td>GET Category Using Id</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_categoryDetails/?API-KEY=98745612&lang=en&id=1</td>
        <td>http://volive.in/joher/api/Service/get_categoryDetails/?API-KEY=98745612&lang=en&id=1</td>
      </tr>
      
       <tr>
        <td>8</td>
        <td>24-07-2018</td>
        <td>GET Event List</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=en</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=en</td>
      </tr>
      
      <tr>
        <td>9</td>
        <td>24-07-2018</td>
        <td>GET Event Using Id</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=en&id=1</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=en&id=1</td>
      </tr>
      
       <tr>
        <td>10</td>
        <td>25-07-2018</td>
        <td>GET Event By Months</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=en&months=07</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=en&months=07</td>
      </tr>
      
      <tr>
        <td>11</td>
        <td>25-07-2018</td>
        <td>GET Event By Day</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=ar&day=26</td>
        <td>http://volive.in/joher/api/Service/get_eventDetails/?API-KEY=98745612&lang=ar&day=26</td>
      </tr>
      
      
      <tr>
        <td>12</td>
        <td>25-07-2018</td>
        <td>GET Wallet Amount</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_walletDetails/?API-KEY=98745612</td>
        <td>http://volive.in/joher/api/Service/get_walletDetails/?API-KEY=98745612</td>
      </tr>
      
      <tr>
        <td>13</td>
        <td>25-07-2018</td>
        <td>Add Wallet Money</td>
        <td>POST</td>
        <td>http://volive.in/joher/api/Service/add_user_wallet_amount</td>
        <td>API-KEY=98745612,userid,amount,lang</td>
      </tr>
      
      <tr>
        <td>14</td>
        <td>26-07-2018</td>
        <td>User Wallet Details</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/user_walletDetails/?API-KEY=98745612&user_id=158</td>
        <td>http://volive.in/joher/api/Service/user_walletDetails/?API-KEY=98745612&user_id=158</td>
      </tr>
      
      <tr>
        <td>15</td>
        <td>26-07-2018</td>
        <td>Add Place</td>
        <td>POST</td>
        <td>http://volive.in/joher/api/Service/add_place</td>
        <td>API-KEY=98745612,user_id,title,note,location,latitude,longitude,place_image,lang</td>
      </tr>
      
      <tr>
        <td>16</td>
        <td>26-07-2018</td>
        <td>Get Place Details</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/get_palceDetails/?API-KEY=98745612&lang=ar&user_id=158</td>
        <td>http://volive.in/joher/api/Service/get_palceDetails/?API-KEY=98745612&lang=ar&user_id=158</td>
      </tr>
      
       <tr>
        <td>17</td>
        <td>27-07-2018</td>
        <td>Delete Place</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/deletePlace/?API-KEY=98745612&id=6&lang=en</td>
        <td>http://volive.in/joher/api/Service/deletePlace/?API-KEY=98745612&id=6&lang=en</td>
      </tr>
      
       <tr>
        <td>18</td>
        <td>01-08-2018</td>
        <td>Get Invoice Details</td>
        <td>GET</td>
        <td>http://volive.in/joher_new/api/Service/invoice/?API-KEY=98745612&user_id=161&lang=en</td>
        <td>http://volive.in/joher_new/api/Service/invoice/?API-KEY=98745612&user_id=161&lang=en</td>
      </tr>
     
      <tr>
        <td>19</td>
        <td>01-08-2018</td>
        <td>Get Invoice Using Id</td>
        <td>GET</td>
        <td>http://volive.in/joher_new/api/Service/invoice/?API-KEY=98745612&user_id=161&lang=en&id=1</td>
        <td>http://volive.in/joher_new/api/Service/invoice/?API-KEY=98745612&user_id=161&lang=en&id=1</td>
      </tr>
      
      <tr>
        <td>20</td>
        <td>02-08-2018</td>
        <td>Get Delete Invoice Using Id</td>
        <td>GET</td>
        <td>http://volive.in/joher_new/api/Service/deleteInvoice/?API-KEY=98745612&id=1&lang=en</td>
        <td>http://volive.in/joher_new/api/Service/deleteInvoice/?API-KEY=98745612&id=1&lang=en</td>
      </tr>
      
       <tr>
        <td>21</td>
        <td>02-08-2018</td>
        <td>Make Payment Using Wallet</td>
        <td>POST</td>
        <td>http://volive.in/joher_new/api/Service/makepayment</td>
        <td>API-KEY=98745612,lang,user_id,payamount,walletamount,i_id</td>
      </tr>
      
      <tr>
        <td>22</td>
        <td>03-08-2018</td>
        <td>Get Order List</td>
        <td>GET</td>
        <td>http://volive.in/joher_new/api/Service/ordersdetails/?API-KEY=98745612&user_id=142&lang=en</td>
        <td>http://volive.in/joher_new/api/Service/ordersdetails/?API-KEY=98745612&user_id=142&lang=en</td>
      </tr>
      
      
      <tr>
        <td>23</td>
        <td>03-08-2018</td>
        <td>Get Order List using Id</td>
        <td>GET</td>
        <td>http://volive.in/joher_new/api/Service/ordersdetails/?API-KEY=98745612&user_id=142&lang=en&id=6</td>
        <td>http://volive.in/joher_new/api/Service/ordersdetails/?API-KEY=98745612&user_id=142&lang=en&id=6</td>
      </tr>
      
     <tr>
        <td>24</td>
        <td>10-08-2018</td>
        <td>Get Call Number</td>
        <td>GET</td>
        <td>http://volive.in/joher/api/Service/request_call/?API-KEY=98745612&lang=ar</td>
        <td>http://volive.in/joher/api/Service/request_call/?API-KEY=98745612&lang=ar</td>
      </tr>  
      
      <tr>
        <td>25</td>
        <td>16-08-2018</td>
        <td>Update Profile</td>
        <td>POST</td>
        <td>http://volive.in/joher/api/Service/profile</td>
        <td>API-KEY=98745612&lang=ar,name,password,profile_image,user_id</td>
      </tr>  
      
    </tbody>
  </table>
</div>

</body>
</html>
