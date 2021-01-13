<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
	
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.html	*/
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }
  $link = create_connection();
					
  //檢查帳號密碼是否正確
  $id = $_COOKIE["id"];
  $sql = "SELECT * FROM users Where id = '$id'";
  $result = execute_sql($link, "member", $sql);
  $row = mysqli_fetch_object($result);
  $name = $row->name;
  $telephone = $row->telephone;
  $address = $row->address; 
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
		
    //關閉資料連接	
    mysqli_close($link);

    //將使用者資料加入 cookies
    setcookie("name", $name);
    setcookie("telephone", "asdfasf");
    setcookie("address",$address);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>書城</title>
    <meta charset="utf-8">
    <link href="mainpage.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" type="text/css" />
  </head>
  <body bgcolor="#9CCDCD">
     <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top mb-5 shadow">
  <div class="container">
    <a class="navbar-brand" href="#">Book Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="catalog.php">產品型錄
                <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopping_car.php">檢視購物車</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="print_order.php">列印訂購單</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="modify.php">修改會員資料</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="delete.php">刪除會員資料</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="news.php">討論區</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Sigh out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Content -->
<div class="container">
  <div class="card border-0 shadow my-5">
    <div class="card-body p-5">      
    <?php include "catalog.php";?>
    
    </div>
  </div>
</div>
  </body>
</html>