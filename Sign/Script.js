function checkUsername() {
  var username = document.getElementById('username').value;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'checkUsername.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var usernameTaken = document.getElementById('usernameTaken');
      if (response.taken) {
        usernameTaken.style.display = 'block';
      } else {
        usernameTaken.style.display = 'none';
      }
    }
  };
  xhr.send('username=' + encodeURIComponent(username));
}



// Scripts.js
function handleSubmit(event) {
  event.preventDefault(); // Prevent default form submission

  if (!validateForm()) {
      return; // Exit if form validation fails
  }

  var formData = new FormData(); // Create a FormData object
  formData.append('fullname', document.getElementById('fullname').value.trim());
  formData.append('email', document.getElementById('email').value.trim());
  formData.append('username', document.getElementById('username').value.trim());
  formData.append('password', document.getElementById('password').value);

  // Send form data to PHP script using fetch API
  fetch('InsertUser.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      // Handle response from PHP script (e.g., show success message or error)
      console.log(data);
      // You can handle the response here and show appropriate messages to the user
  })
  .catch(error => {
      console.error('Error:', error);
  });
}

// Function to validate form inputs
function validateForm() {
  var fullname = document.getElementById('fullname').value.trim();
  var email = document.getElementById('email').value.trim();
  var username = document.getElementById('username').value.trim();
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;

  // Check if any field is empty
  if (fullname === '' || email === '' || username === '' || password === '' || confirmPassword === '') {
      alert('Please fill in all fields');
      return false;
  }

  var namePattern = /^[A-Za-z\s]+$/;
  if (!fullname.match(namePattern)) {
      alert('Full name should not contain numbers');
      return false;
  

  // Validate email format
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email.match(emailPattern)) {
      alert('Please enter a valid email address');
      return false;
  }

  // Validate username (simple check for length)
  if (username.length < 4 || username.length > 20) {
      alert('Username must be between 4 and 20 characters');
      return false;
  }

  // Validate password (simple check for length)
  if (password.length < 6) {
      alert('Password must be at least 6 characters long');
      return false;
  }

  // Check if passwords match
  if (password !== confirmPassword) {
      alert('Passwords do not match');
      return false;
  }

  // If all validations pass, return true to submit the form
  return true;
}

// Function to check if passwords match
function checkPasswordMatch() {
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var passwordMismatch = document.getElementById('passwordMismatch');

  if (password !== confirmPassword) {
      passwordMismatch.style.display = 'block';
  } else {
      passwordMismatch.style.display = 'none';
  }
}


// Scripts.js

// Function to handle form submission
function handleSubmit(event) {
  event.preventDefault(); // Prevent default form submission

  if (!validateForm()) {
      return; // Exit if form validation fails
  }

  var formData = new FormData(); // Create a FormData object
  formData.append('fullname', document.getElementById('fullname').value.trim());
  formData.append('email', document.getElementById('email').value.trim());
  formData.append('username', document.getElementById('username').value.trim());
  formData.append('password', document.getElementById('password').value);

  // Send form data to PHP script using fetch API
  fetch('InsertUser.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      // Handle response from PHP script (e.g., show success message or error)
      console.log(data);
      // You can handle the response here and show appropriate messages to the user
  })
  .catch(error => {
      console.error('Error:', error);
  });
}

// Function to validate form inputs
function validateForm() {
  // Same validation logic as before
  // Ensure to return true or false based on validation
}

// Function to check if passwords match (if needed)
function checkPasswordMatch() {
  // Same check as before
}

// Event listener for form submission
document.querySelector('form').addEventListener('submit', handleSubmit);


