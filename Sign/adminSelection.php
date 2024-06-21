<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Selection</title>
    <!-- Include necessary CSS styles -->
    <link rel="stylesheet" href="path/to/your/styles.css">
    <!-- Include necessary JavaScript libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <script>
        // Function to show SweetAlert confirmation dialog
        function showConfirmation(role) {
            Swal.fire({
                title: 'Do you want to log in as ' + role + '?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'adminLogin.php?role=' + role.toLowerCase();
                } else {
                    window.location.href = '../index.php'; // Redirect to regular user login
                }
            });
        }
    </script>

    <div class="container">
        <h1>Welcome Admin!</h1>
        <p>Please choose how you want to log in:</p>
        <button onclick="showConfirmation('Admin')">Log in as Admin</button>
        <button onclick="showConfirmation('User')">Log in as User</button>
    </div>
</body>

</html>