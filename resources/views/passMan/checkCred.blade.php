@extends('layouts.app')
@section('main')

<head>
    <title>PassMan | Credentials</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
@if($message = Session::get('success'))
<div class="alert alert-success alert-block"><strong>{{$message}}</strong></div>
@endif
@if($message = Session::get('fail'))
<div class="alert alert-danger alert-block"><strong>{{$message}}</strong></div>
@endif

<div class="container">
    <div class="card justify-content-center text-white rounded-20" id="credentials-card">
        <table class="table table-hover mt-2" id="credentials-table">
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Website</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Controls</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$result->website}}</td>
                    <td>{{$result->username}}</td>
                    <td>
                        <div class="input-group">
                            <input type="password" class="form-control masterkey" name="masterkey" placeholder="Enter your Master Key" required>
                            <button type="submit" class="btn btn-outline-secondary reveal-password" data-encrypted-password="{{ $result->password }}" aria-label="Reveal Password">&#128065;</button>
                        </div>
                        <span class="password-display"></span>
                    </td>
                    <td>
                        <a href="/edit" id = "editBtn" class="btn btn-primary btn-lg" title="Edit">
                        <i class="fas fa-edit"></i>
                        </a>
                        <form action="/delete/{{$result->id}}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this credential?')" title="Delete">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
                
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--script for showing the password-->
<script>
    document.querySelectorAll('.reveal-password').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr'); // Get the parent row of the button
        if (!row) {
            console.error('Row element not found');
            return;
        }

        const passwordField = row.querySelector('.form-control');
        const passwordDisplay = row.querySelector('.password-display');

        if (!passwordField || !passwordDisplay) {
            console.error('Password field or password display element not found');
            return;
        }

        const masterkey = passwordField.value;
        const encryptedPassword = this.dataset.encryptedPassword;

        fetch('/decrypt', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                masterkey: masterkey,
                encryptedPassword: encryptedPassword
            })
        })
        .then(response => response.json())
        .then(data => {
            passwordField.parentElement.remove(); // Remove the input field and button
            passwordDisplay.textContent = data.decryptedPassword;
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>

<!--Modal-->
<div id="masterKeyModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="masterKeyForm">
      <label for="masterKey">Enter Master Key:</label>
      <input type="password" id="masterKey" name="masterKey" required>
      <button type="submit">Submit</button>
    </form>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("masterKeyModal");

// Get the button that opens the modal
var btn = document.getElementById("editBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user submits the master key form
document.getElementById("masterKeyForm").addEventListener('submit', function(event) {
  event.preventDefault();
  var masterKey = document.getElementById("masterKey").value;
  
  // Perform an AJAX request to validate the master key
  // If the master key is valid, proceed with the edit action
  // Otherwise, display an error message
});
</script>

@endsection
