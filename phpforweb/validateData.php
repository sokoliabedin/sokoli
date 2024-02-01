<?php

class User {
    private $username;
    private $password;

    // Constructor to initialize the username and password
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    // Getter methods if needed

    // Validation method to check if username and password are valid
    public function validate() {
        $errors = [];

        // Validate username
        if (empty($this->username)) {
            $errors["username"] = "Username is required";
        } else {
            echo " Fuck outta here "
        }

        // Validate password
        if (empty($this->password)) {
            $errors["password"] = "Password is required";
        } else {
            echo " No login for you buddy "
        }

        return $errors;
    }

    // Login method to perform the login logic
    public function login() {
        $validCredentials = [
            "valid_username" => "hashed_password"]; // The value hashed_password is a placeholder for the hashed password , stores the passwords , verify checks them.
        // Check if the provided username exists
        if (array_key_exists($this->username, $validCredentials)) {
            // Check if the provided password matches the stored hashed password
            if (password_verify($this->password, $validCredentials[$this->username])) {
                return true;
            }
        }
        return false;
    }

    public function Registration() {
       $hasedPassword = password_hash($this->password , PASSWORD_DEFAULT);

       $sql = "INSERT INTO users (username , password)  VALUES (:username , password)";

       return true;
    }
}

// check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a User object with the provided username and password , instance
    $user = new User($username, $password);

    // Validate user input
    $errors = $user->validate();

    // Redirecting
    if (empty($errors)) {
        if ($user->login()) {
            header("Location: index.html");
            exit();
        } else {
            $errors["login"] = "Invalid username or password"; // error message
        }
    }
}

?>

<!--------------------------------------------------------- HTML --------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>

<!-- Display errors if any -->
<?php if (!empty($errors)):?>
    <div style="color: red;">
        <?php foreach($errors as $error) : ?>
            <p> <?php echo $error ?> </p>
        <?php endforeach; ?>
    </div>
</php endif; ?>

<!---------------------------------------------------------Login---------------------------------------------------->
<form id="signinForm" action="" method="post">
  <h2>Log in</h2>
  <div class="inputBox">
    <input type="text" placeholder="Username" name="username" />
  </div>
  <div class="inputBox">
    <input
      type="password"
      placeholder="Password"
      name="password"
      id="loginPassword"
      required
    />
    <span
      class="password-toggle"
      onclick="togglePassword('loginPassword')"
      >👁️</span
    >
  </div>
  <div class="inputBox group">
    <a href="#"> Forgot Password </a>
    <a href="#" id="signup"> Signup </a>
  </div>
  <div class="inputBox">
    <input type="submit" value="Sign in" />
  </div>
</form>

<!---------------------------------------------------------Registration ---------------------------------------------------->
<form id="signupForm" action="" method="post">
  <h2>Registration</h2>
  <div class="inputBox">
    <input
      type="text"
      placeholder="Username"
      id="username"
      name="username"
      required
    />
  </div>
  <div class="inputBox">
    <input
      type="text"
      placeholder="Email Address"
      name="email"
      required
    />
  </div>
  <div class="inputBox">
    <input
      type="password"
      placeholder="Create Password"
      id="regPassword"
      name="password"
      required
    />
    <span class="password-toggle" onclick="togglePassword('regPassword')"
      >👁️</span
    >
  </div>
  <div class="inputBox">
    <input
      type="password"
      placeholder="Confirm Password"
      id="confirmPassword"
      name="confirmPassword"
      required
    />
    <span
      class="password-toggle"
      onclick="togglePassword('confirmPassword')"
      >👁️</span
    >
   </div>
   <div class="inputBox">
     <input type="submit" value="Register Account" />
   </div>
   <div class="inputBox group">
     <a href="#"> Already Have an Account ? <b id="signin"> Login </b> </a>
   </div>
 </form>
</div>


</body>
</html>