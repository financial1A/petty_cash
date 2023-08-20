<!DOCTYPE html>
<html>
<head>
<title>Toyota Lanka Petty Cash Verification</title>
  <link rel="icon" type="image/ico" href="1.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.js"></script>
<script src="bootstrap.min.js"></script>

<style>
  input{
    margin: 3.5px;
  }
  body {
      /* Linear gradient with two colors */
      background: linear-gradient(to bottom, white, #e1e1e1);
      /* For full height */
   
    }

  input, textarea{
    background-color:#e3e3e3; 
  }
</style>
</head>
<body class="container">
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form style="padding: 50px" action="verify.php" method="POST">
        <input type="text" name="login_user" placeholder="User" required>
        <input type="password" name="login" placeholder="Password" required>
        <button type="submit" style="background-color: chartreuse;">Login</button>
    </form>
    <img src="gh.jpg" style="width: 300px;height:260px;" alt="">
    <div style="padding-top:220px;">
<a href="contact.php" ><button class="btn btn-info" ><h5>Contact  </h5></button></a>
</div>
    <footer style="text-align:center;">
        <p>&copy; 2023 Toyota Lanka.</p>
        <p></p>
    </footer>
</body>
</html>





