<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
  <script src="https://cdn.tailwindcss.com"></script>
  <title>PHP MVC</title>
</head>
<body>
  <header class="flex justify-between items-center">
    <h1>
      PHP MVC
    </h1>
    <div>
      <a href="/">Home</a>
      <a href="/contact">Contact</a>
    </div>
    <div>
      <a href="/register">Register</a>
      <a href="/login">Login</a>
    </div>
  </header> 

  {{ content }}

  <footer>
    <p>Copyright</p>
  </footer>
</body>
</html>