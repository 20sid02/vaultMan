<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>PassMan | Sign Up</title>
</head>

<body style="background-color: #000000dc;" class = "text-white">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/resource/login.png" alt="Avatar Logo" style="width:90px;" class="rounded-pill">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active text-white" href="/">Login</a>
                </li>
              </ul>
        </div>
    </nav>

    @if($message = Session::get('success'))
        <div class = "alert alert-success alert-block"><strong>{{$message}}</strong></div>
    @endif
    @if($message = Session::get('fail'))
        <div class = "alert alert-danger alert-block"><strong>{{$message}}</strong></div>
    @endif

<div class = "container">
<div class = "row justify-content-center">
<div class = "col-sm-8">
<div class = "m-3 p-3">

    <form action="/register" method = "post" class = "m-2 p-3">
        @csrf
        <div class = "rounded p-4 shadow m-2">
            <div class="mb-3 mt-3">
                <label for="username" class="form-label">Username:</label>
                <input type="username"  value=  "{{old('username')}}" class="form-control" id="username" placeholder="Enter username" name="username" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">E-Mail:</label>
                <input type="email" value = "{{old('email')}}" class="form-control" id="email" placeholder="Enter Email address" name="email" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confpwd" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confpwd" placeholder="Enter your password again" name="confpassword" required>
            </div>
            <button type="submit" class="btn btn-secondary m-3">Sign Up</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
        
</body>

</html>