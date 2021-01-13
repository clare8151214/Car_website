<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE 
  $passed = $_COOKIE{"passed"};
	
  //如果 cookie 中的 passed 變數不等於 TRUE
  //表示尚未登入網站，將使用者導向首頁 index.html
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }
	
  //如果 cookie 中的 passed 變數等於 TRUE
  //表示已經登入網站，取得使用者資料	
  else
  {
    require_once("dbtools.inc.php");
		
    $id = $_COOKIE{"id"};
		
    //建立資料連接
    $link = create_connection();
				
    //執行 SELECT 陳述式取得使用者資料
    $sql = "SELECT * FROM users Where id = $id";
    $result = execute_sql($link, "member", $sql);
		
    $row = mysqli_fetch_assoc($result);  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>修改會員資料</title>
    <meta charset="utf-8">
    <link href="registerpage.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.password.value.length == 0)
        {
          alert("「使用者密碼」一定要填寫哦...");
          return false;
        }
        if (document.myForm.password.value.length > 10)
        {
          alert("「使用者密碼」不可以超過 10 個字元哦...");
          return false;
        }
        if (document.myForm.re_password.value.length == 0)
        {
          alert("「密碼確認」欄位忘了填哦...");
          return false;
        }
        if (document.myForm.password.value != document.myForm.re_password.value)
        {
          alert("「密碼確認」欄位與「使用者密碼」欄位一定要相同...");
          return false;
        }
        if (document.myForm.name.value.length == 0)
        {
          alert("您一定要留下真實姓名哦！");
          return false;
        }	
        if (document.myForm.year.value.length == 0)
        {
          alert("您忘了填「出生年」欄位了...");
          return false;
        }
        if (document.myForm.month.value.length == 0)
        {
          alert("您忘了填「出生月」欄位了...");
          return false;
        }	
        if (document.myForm.month.value > 12 | document.myForm.month.value < 1)
        {
          alert("「出生月」應該介於 1-12 之間哦！");
          return false;
        }
        if (document.myForm.day.value.length == 0)
        {
          alert("您忘了填「出生日」欄位了...");
          return false;
        }
        if (document.myForm.month.value == 2 & document.myForm.day.value > 29)
        {
          alert("二月只有 28 天，最多 29 天");
          return false;
        }	
        if (document.myForm.month.value == 4 | document.myForm.month.value == 6
          | document.myForm.month.value == 9 | document.myForm.month.value == 11)
        {
          if (document.myForm.day.value > 30)
          {
            alert("4 月、6 月、9 月、11 月只有 30 天哦！");
            return false;					
          }
        }	
        else
        {
          if (document.myForm.day.value > 31)
          {
            alert("1 月、3 月、5 月、7 月、8 月、10 月、12 月只有 31 天哦！");
            return false;					
          }				
        }
        if (document.myForm.day.value > 31 | document.myForm.day.value < 1)
        {
          alert("出生日應該在 1-31 之間");
          return false;
        }	
        myForm.submit();					
      }
    </script>			
  </head>
  <body>
  <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-img-left d-none d-md-flex">
               <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body">
              <h5 class="card-title text-center">Register</h5>
              <form class="form-signin" action="update.php" method="post" name="myForm">
                
                <div class="form-label-group">
                  <input name="account" type="text" id="inputEmail" class="form-control" placeholder="account" value="<?php echo $row{"account"} ?>" required>
                  <label for="inputEmail">Account</label>
                </div>
  
                
                <div class="form-label-group">
                  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="password" value="<?php echo $row{"password"} ?>" required>
                  <label for="inputPassword">Password(請使用英文或數字鍵，勿使用特殊字元)</label>
                </div>
                
                <div class="form-label-group">
                  <input name="re_password" type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" value="<?php echo $row{"password"} ?>"  required>
                  <label for="inputConfirmPassword">Confirm password</label>
                </div>
  
                <hr>
  
                <div class="form-label-group">
                  <input name="name" type="text" id="inputUserame" class="form-control" placeholder="Username" value="<?php echo $row{"name"} ?>" required autofocus>
                  <label for="inputUserame">Username</label>
                </div>
  
                
                <hr>
                <!-- Material checked -->
                <div class="form-check">
                  <input type="radio" name="sex" value="男" class="form-check-input" id="materialChecked" name="materialExampleRadios" checked>
                  <label class="form-check-label" for="materialChecked">Male</label>
                </div>
  
                <!-- Material unchecked -->
                <div class="form-check">
                  <input type="radio" name="sex" value="女" class="form-check-input" id="materialUnchecked" name="materialExampleRadios">
                  <label class="form-check-label" for="materialUnchecked">Female</label>
                </div>
  
                <hr>
                <p>Birthday</p>
                <div class="form-label-group">
                  <input name="year" type="text" id="year" class="form-control" placeholder="year" required     value="<?php echo $row{"year"} ?>" autofocus>
                  <label for="year">Year</label> 
                </div>
                <div class="form-label-group">
                  <input name="month" type="text" id="month" class="form-control" placeholder="month" required value="<?php echo $row{"month"} ?>" autofocus>
                  <label for="month">Month</label>
                </div>
  
                <div class="form-label-group">
                  <input name="day" type="text" id="day" class="form-control" placeholder="day" value="<?php echo $row{"day"} ?>" required      autofocus> 
                  <label for="day">Day</label>
                </div>
  
                <hr>
  
                <div class="form-label-group">
                  <input name="telephone" type="text" id="telephone" class="form-control" placeholder="telephone" value="<?php echo $row{"telephone"} ?>" required>
                  <label for="telephone">Telephone</label>
                </div>
  
                <div class="form-label-group">
                  <input name="cellphone" type="text" id="cellphone" class="form-control" placeholder="cellphone" value="<?php echo $row{"cellphone"} ?>" required>
                  <label for="cellphone">Cellphone</label>
                </div>
  
                <div class="form-label-group">
                  <input name="address" type="text" id="address" class="form-control" placeholder="address" value="<?php echo $row{"address"} ?>" required>
                  <label for="address">Address</label>
                </div>
  
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="email" value="<?php echo $row{"email"} ?>" required>
                  <label for="email">Email</label>
                </div>
                
                
                <div class="form-label-group">
                  <input name="url" type="text" value="http://" id="url" class="form-control" placeholder="url" value="<?php echo $row{"url"} ?>" required>
                  <label for="url">Personal Website</label>
                </div>
  
                <hr>
  
                <div class="form-group">
                  <label for="comment" class="control-label">備註</label>
                  <textarea id="comment" name="comment" cols="45" rows="4" class="form-control" ><?php echo $row{"comment"} ?></textarea>
                </div>
  
  
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" onclick="check_data()">修改資料</button>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="reset">Reset</button>
                <hr class="my-4">
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>