<html>  
    <head>  
        <title>Employee Login/Registration System With Source Code</title>  
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <script>
            swal({
                title: "Congrulations!",
                text: "You Are Successfully Login",
                icon: "success",
                button: 'Ok'
                });
        </script>
        <div class='contanier'>
            <div class="col-msd-12 text-center" style="margin-top:250px;">
                <h3>Welcome ! <?php session_start(); echo '<b>'.$_SESSION['username'].'<b>'; ?> <a href="logout.php"><button type="button" class="btn btn-primary">Logout <i class="fa fa-sign-out"></i></button></a></h3>
            </div>
        </div>
    </body>
</html>