<!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>

<!-- ccc link -->
<!-- <link rel="stylesheet" href="css/adminpage.css"> -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');


*{
   font-family:'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   background-color:#eee;
}

.container{
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:20px;
   padding-bottom: 60px;
}

.container 
.content{
   /* ,container .content le container bhitra ko content lai matra style garcha */
   text-align: center;
}

.container 
.content h3{
   font-size: 30px;
   /* color:#333; */
   color:#black;
}

.container     
.content h3 span{
   background: green;
   color:#fff;
   border-radius: 5px;
   padding:0 15px;
}
.container     
.content h3 span:hover{
   /* background: blue;    */
   cursor: pointer;
}
.container .content h1{
   font-size: 50px;
   color:#black;
}


.container .content .btn{
   display: inline-block;
   padding:10px 30px;
   font-size: 20px;
   background: #333;
   color:#ccc;
   background-color:green;
   border-radius: 5px;  
   margin:0 4px;
   text-transform: capitalize;
}

.container .content .btn:hover{
   background:teal;
}
</style>
   </head>
   <body>
    <div class="container">
        <div class="content">
        
        <br><br><br>
            <h3>Hi,<span>Admin</span></h3>
            <h1>welcome</h1>
            
            <a href="admindashphp/adminpanel.php" class="btn">Dashboard</a>
            <a href="front.php" class="btn">Logout</a>
</div></div>
 </body> 
   </html>

 