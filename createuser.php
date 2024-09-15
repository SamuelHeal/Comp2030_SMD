<!DOCTYPE html>
<html lang="en">
<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Group 18" />
    <link rel="stylesheet" href="./styles/style.css">
    <script src="./scripts/script.js" defer></script>
</head>
<body>
    
    <h1>Create User</h1>
    <form action="createusersystem.php" method="POST">
        <label for="firstname">First name:</label> 
        <input id="firstname" name="firstname" required type="text" />
        <label for="lastname">Last name:</label>
        <input id="lastname" name="lastname" required type="text" />
        <label for="dob">Date of birth:</label>
        <input id="dob" name="dob" required type="date" />
        <label for="position">Position:</label>
        <input id="position" name="position" required type="text" />
        <label for="phonenumber">Phone number:</label>
        <input id="phonenumber" name="phonenumber" required type="text" />
        <label for="email">Email:</label>
        <input id="email" name="email" required type="text" />
        <label for="employmentdate">Date of employment:</label>
        <input id="employmentdate" name="employmentdate" required type="date" />
        <label for="pin">User pin:</label>
        <input id="pin" name="pin" required type="text" />
        <input name="register" type="submit" value="Register" />
    </form>
</body>
</html>