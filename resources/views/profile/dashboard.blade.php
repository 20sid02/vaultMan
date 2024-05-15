@extends('layouts.app')
@section('main')

<head>
  <title>PassMan | Dashboard</title>
  <link rel = "stylesheet" href = "/css/app.css">
  <script src = "/js/app.js"></script>
</head>

@if($message = Session::get('success'))
<div class="alert alert-success alert-block" id = "dialogBox" style="after{
  display: inline-block;
  content: '\00d7'; 
}">
<button type="button"  onclick = "closeBox()" class="btn-close" aria-label="Close">
           
        </button>
<strong>{{$message}}</strong></div>
@endif


@if($message = Session::get('fail'))
<div class="alert alert-danger alert-block">
<button type="button"  onclick = "closeBox()" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
<strong>{{$message}}</strong>

</div>
@endif

<div class="container">
  <div class="card justify-content-center text-white rounded-20" style="background-color:#303030">
    <div class="m-3 p-3" style="text-align:center;">
      <h1>Welcome to your Dashboard {{auth()->user()->username}}</h1><br>
      <p class="fs-4">Your password manager is your digital keychain, securely storing all your login credentials in one place. From here, you can easily manage and access your passwords, ensuring security and convenience across all your accounts.</p><br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-5">
            <form method="post" action="/addtoVault">
              @csrf
              <div class="rounded p-4 shadow" style="background-color:#303030">
                <div class="mb-3 mt-3">

                  <input type="username" value="{{old('username')}}" class="form-control" id="username" placeholder="Enter username" name="username" required>
                </div>
                <div class="mb-3 mt-3">

                  <input type="url" value="{{old('website')}}" class="form-control" id="website" placeholder="Enter website" name="website" required>
                </div>
                <div class="mb-3">

                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                </div>
                <button type="submit" class="btn btn-secondary">Add Credentials</button>
              </div>
            </form>
            
          </div>
          
          <div class="col-sm-7 rounded text-start">
            <h2 class = "text-center">Recent Changes</h2>
            <br><p><ul class = "lead" style = "list-style-type:none;">
              @foreach($recentChanges->take(3) as $recent)
              <li>{{$recent->action}} -> {{$recent->item}}</li>
              @endforeach
            </ul></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection