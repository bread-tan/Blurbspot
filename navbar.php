<?php
  session_start();
?>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"><strong>Blurbspot!</strong></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php"><span class='glyphicon glyphicon-home'></span><strong> Home</strong></a></li>
      <li><a href="#"><span class='glyphicon glyphicon-music'></span><strong> Artist of The Week</strong></a></li>
      <li><a href="#"><span class='glyphicon glyphicon-music'></span><strong> Band of The Week</strong></a></li>
      <li><a href="#"><span class='glyphicon glyphicon-star'></span><strong> Top 10</strong></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php 
          if(!isset($_SESSION['username']))
          {
            echo "&nbsp;
            <button class='btn btn-info navbar-btn' onclick='signUpModalBringUp()'><span class='glyphicon glyphicon-edit'></span>&nbsp;Sign Up!</button>
            &nbsp;
            <button class='btn btn-primary navbar-btn' onclick='signInModalBringUp()'><span class='glyphicon glyphicon-log-in'></span>&nbsp;Sign In</button>&nbsp;&nbsp;";
          }
          else
          {
            echo "&nbsp;<button class='btn btn-info navbar-btn' onclick=''><span class='glyphicon glyphicon-user'></span>&nbsp;Hi there, ".$_SESSION['username']."!</button>";
            echo "&nbsp;<button class='btn btn-primary navbar-btn' onclick='signOut()'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Sign Out</button>&nbsp;&nbsp;";
          }
        ?>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<!-- Sign In Modal -->
  <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Sign In Form</h4>
        </div>
        <div class="modal-body">
          <form>
            <input type="text" id='signInUsername' class="form-control" placeholder='Enter Your Username' autofocus>
            <br>
            <input type="password" id='signInPassword' class="form-control" placeholder='Enter Your Password'>
            <br>
            <input type="button" class='btn btn-primary' value='Log In!' onclick="validateSignIn()">
            <input type="reset" class='btn btn-default' value='Clear' onclick='hideAlert("signInErrorDiv")'>
          </form>
          <div id='signInErrorDiv' style='display:none;'>
            <br><br>
            <div class="alert alert-danger">
              <strong>Opps!</strong> <p id='signInErrorMessage'>Sign In failed.</p>
            </div>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Sign Up Modal -->
  <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Sign Up Form</h4>
        </div>
        <div class="modal-body">
          <form>
            <input type="text" id='signUpUsername' class="form-control" placeholder='Enter A Username'>
            <br>
            <input type="password" id='signUpPass1' class="form-control" placeholder='Enter A Password'>
            <br>
            <input type="password" id='signUpPass2' class="form-control" placeholder='Re-enter Password'>
            <br>
            <input type="button" class='btn btn-info' value='Register' onclick='validateSignUp()'>
            <input type="reset" class='btn btn-default' value='Clear' onclick='hideAlert("signUpErrorDiv")'>
          </form>
          <div id='signUpErrorDiv' style='display:none;'>
            <br><br>
            <div class="alert alert-danger">
              <strong>Opps!</strong> <p id='signUpErrorMessage'>Something went wrong!</p>
            </div>
          </div>

          <div id='signUpSuccessDiv' style='display:none;'>
            <br><br>
            <div  class='alert alert-success' >
              <strong>Success!</strong> You have been registered. <a class='alert-link' href=''>Click here</a> to start! <!-- TODO -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
  function signOut()
  {
    $.post("signOut.php", {})
    .done(function(data)
    {
      window.location='index.php'
    });
  }
  function signInModalBringUp()
  {
    $('#signInModal').modal('toggle');
  }

  function signUpModalBringUp()
  {
    $('#signUpModal').modal('toggle');
  }
  
  function validateSignUp()
  {
    document.getElementById('signInErrorDiv').style.display="none";
    document.getElementById('signUpErrorDiv').style.display="none";
    document.getElementById('signUpSuccessDiv').style.display="none";
  
    var username = document.getElementById('signUpUsername').value;
    var pass1 = document.getElementById('signUpPass1').value;
    var pass2 = document.getElementById('signUpPass2').value;
    if(username == "" || pass1 == "" || pass2 == "")
    {
      document.getElementById('signUpErrorMessage').innerHTML='Fields cannot be left blank.';
      document.getElementById('signUpErrorDiv').style.display="";
      return false;
    }
    if(pass1 != pass2)
    {
      document.getElementById('signUpErrorMessage').innerHTML='Entered passwords don\'t match.';
      document.getElementById('signUpErrorDiv').style.display="";
      document.getElementById('signUpPass1').value="";
      document.getElementById('signUpPass2').value="";
      return false;
    }
  
    $.post("signUp.php", { username: username, password: pass1 })
    .done(function(data)
    { 
      if(data == 'success')
      {
        document.getElementById('signUpSuccessDiv').style.display="";
      }
      else
      {
        document.getElementById('signUpErrorMessage').innerHTML='Registration failed.'+data;
        document.getElementById('signUpErrorDiv').style.display="";
        document.getElementById('signUpPass1').value="";
        document.getElementById('signUpPass2').value="";
      }
    });
  }
  
  function validateSignIn()
  {
    document.getElementById('signInErrorDiv').style.display="none";
  
    document.getElementById('signUpErrorDiv').style.display="none";
    document.getElementById('signUpSuccessDiv').style.display="none";
  
    var username = document.getElementById('signInUsername').value;
    var pass = document.getElementById('signInPassword').value;
    if(username == "" || pass == "")
    {
      document.getElementById('signInErrorMessage').innerHTML='Fields cannot be left blank.';
      document.getElementById('signInErrorDiv').style.display="";
      return false;
    }
    $.post("signIn.php", { username: username, password: pass })
    .done(function(data)
    { 
      if(data == 'success')
      {
        window.location="index.php";
      }
      else
      {
        document.getElementById('signInErrorMessage').innerHTML='Login failed.'+data;
        document.getElementById('signInErrorDiv').style.display="";
        document.getElementById('signInPassword').value="";
      }
    });
  }
  
  function hideAlert(id)
  {
    document.getElementById(id).style.display="none";
  }
</script>