<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head> 
<body style="background-color: #000000dc;" class = "text-white">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <img src="/resource/login.png" alt="Avatar Logo" style="width:90px;" class="rounded-pill">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active text-white" href="/generate">Generate Password</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active text-white" href="/check">Check Credentials</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active text-white" href="/logout">Log Out</a>
                </li>
              </ul>
        </div>
    </nav>
@yield('main')
</body>
</html>