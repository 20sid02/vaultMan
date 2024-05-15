<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>PassMan | Login</title>
</head>

<body style="background-color: #000000dc;" class = "text-white">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/resource/login.png" alt="Avatar Logo" style="width:90px;" class="rounded-pill">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active text-white" href="/signup">Sign Up</a>
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

    <form action="/login" method = "post" class = "m-4 p-4">
        @csrf
        <div class = "rounded shadow m-2 p-2">
            <div class="mb-3 mt-3">
                <label for="username" class="form-label">Username:</label>
                <input type="username" class="form-control" id="username" placeholder="Enter username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" required class="form-control" id="pwd" placeholder="Enter password" name="password">
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-secondary m-3">Submit</button>
        </div>
    </form>
</div>
</div>
</div>
</div>

</body>

</html>