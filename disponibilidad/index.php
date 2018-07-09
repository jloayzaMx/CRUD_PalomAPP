<!DOCTYPE HTML>
<html>
    <head>
        <title>Mantenimiento Disponibilidad</title>
 
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <!-- Include custom CSS. -->
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <a class="navbar-brand" href="../index.php">PalomAPP</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Disponibilidad</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<div id='retrieved-data' style='height:15em;'>

    <img src="images/loading.gif" />
</div>

<script type = "text/javascript" src = "../js/jquery.min.js"></script>
<script type = "text/javascript">
$(function(){

    getdata(1);
});
 
function getdata(pageno){
    
    var targetURL = 'search_results.php?page=' + pageno;
 
  
    $('#retrieved-data').html('<center><img src="../images/loading.gif" /></center>');
 
   
    $('#retrieved-data').load(targetURL).hide().fadeIn('slow');
}
</script>

</body>
</html>
