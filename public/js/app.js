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

function closeBox(){
    document.getElementById("dialogBox").style.display = "none";
}