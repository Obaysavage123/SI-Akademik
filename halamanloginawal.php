<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="master.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="master.css">
    <title>SIAPORT</title>
  </head>
  <body>

  <?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
  }
	?>
   
   
  <!--boxmid-->
  
 
		<form action="cek_login.php" method="post">
    <h3 style="text-align:center;margin-top:40px;color:white;">Silahkan Login</h3>
    
  <div class="box" style="margin-top:10px;">
    <div class=>
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form_login" placeholder="Username .." required="required">
    
    <small id="emailHelp" class="form-text text-muted">Pastikan Username Anda Benar </small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form_login" placeholder="Password .." required="required">
    <button type="submit" class="tombol_login"value="login">Login</button>   
 
  </div>
  <br>
  <small id="emailHelp" class="form-text text-muted">NB: Pastikan Anda Sudah Terdaftar </small>
</form>
</div>



  

  
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
    
  </body>
</html>
