const form = document.getElementById('registerForm');
const responseDiv = document.getElementById('response');

form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Collect form data
    const formData = new FormData(form);

    // Send data to PHP using Fetch API
    fetch('register.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text()) // Get response as text
        .then(data => {
            responseDiv.innerHTML = data; // Display response
        })
        .catch(error => {
            responseDiv.innerHTML = `<span style="color: red;">Error: ${error.message}</span>`;
        });
});