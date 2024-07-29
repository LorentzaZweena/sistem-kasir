<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>

        body{
            background-color: whitesmoke;
        }
        .login_main{
            display: flex;
            margin-top: 5.5em;
            margin-left: 31em;
            text-decoration: none;
    }

.loginpage_logo{
    width: 175px;
    margin-top: 25px;
}

.loginpage_rightcomponent{
    height: 350px;
    width: 350px;
    border: 1px solid #DBDBDB;
    margin-top: 25px;
    text-align: center;
    background-color: white;
    border-radius: 2%;
}

.loginPage_signin{
    margin-top: 25px;
}

.loginpage_text{
    width: 250px;
    height: 36px;
    margin: 5px;
    border: 1px solid #DBDBDB;
    background-color: #FAFAFA;
    padding-left: 10px;
    border-radius: 5px;
}

.login_button{
    width: 270px;
    height: 36px;
    border-radius: 5px;
    font-weight: bold;
    margin-top: 10px;
    border: 1px solid #0395f6;
    background-color: #0395f6;
    color: white;
}

.login__ordiv {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.login_divider1{
    width: 80px;
    height: 0px;
    margin-top: 23px;
    border: 1px solid #DBDBDB;
    margin-left: 3.6em;
}

.login_divider2{
    width: 80px;
    height: 0px;
    border: 1px solid #DBDBDB;
    margin-left: 13em;
    margin-top: -2.9em;
}

.login_or{
    font-weight: bold;
    color: #BEBEBE;
    margin-bottom: 2em;
    margin-top: -0.7em;
}

.login_fb{
    color: #395185;
    font-weight: bold;
    margin-top: 30px;
}

.login_forgot{
    color: rgba(var(--fe0, 0, 55, 107), 1);
    font-size: 14px;
    line-height: 14px;
    margin-top: 15px;
    text-align: center;
}

.loginpage_signupoption{
    margin-top: 25px;
    height: 59px;
    width: 350px;
    background-color: white;
    border: 1px solid #DBDBDB;
    text-align: center;
    text-decoration: none;
}

.loginpage_sigin p{
    margin-top: 1em;
    font-size: 0.5em;
    text-decoration: none;
    color: #0395f6;
}

.loginpage_sigin a{
    text-decoration: none;
    color: #0395f6;
}

.loginpage_sigin span{
    color: #0395f6;
    text-decoration: none;
}

.loginpage_sigin{
    font-size: 1em;
}

.loginpage_signup{
    margin-top: 30px;
}

.loginpage_downloadsection{
    height: 105px;
    width: 350px;
    text-align: center;
    margin-top: 20px;
}

.loginpage_option{
    margin-top: 20px;
}

.loginpage_dwimg{
    margin: 5px;
}
    </style>
</head>
<body>
    <?php 
        include("koneksi.php");
    ?>
    <?php
    // Start the session at the top of the script
    session_start();

    // Include the database connection
    include("koneksi.php");

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Escape user inputs for security
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            // Query to select user from the database
            $sql = "SELECT * FROM `kasir` WHERE `nama` = '$username' AND `password` = '$password'";
            $query = mysqli_query($db, $sql);

            // Check if the query was successful and if user exists
            if ($query && mysqli_num_rows($query) > 0) {
                // Fetch user data
                $data = mysqli_fetch_array($query);

                // Set session variables
                $_SESSION['status'] = $data['login'];
                $_SESSION['id_admin'] = $data['id_admin'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['login'] = true;

                // Redirect to the desired page
                header('Location: sistem_kasir.php');
                exit(); // Ensure no further code is executed after redirect
            } else {
                // Optional: Provide feedback if login fails
                echo '<div class="alert alert-danger text-center">Invalid username or password</div>';
            }
        }
    }
?>
<div>
        <form method="POST">
        <div>
                        <div class="login_main">
                            <div>
                                <!-- <h1>Login</h1> -->
                            </div>
                        <div>
                        <div class="loginpage_rightcomponent">
                        <h3 class="mt-4">Login</h3>
                            <div class="loginPage_signin">
                                <!-- <input class="loginpage_text" type="text" name="Username" placeholder="Username" required/>
                                <input class="loginpage_text" type="password" placeholder="Password" name="password" required/>
                                <br>
                                <input type="submit" value="login">
                                    <button type="button" class="btn btn-primary mt-2" style="width: 40%;" value="login">Log in</button>
                                </input> -->
                                <table>
                <tr>
                    <!-- <td>Username</td> -->
                    <!-- <td>:</td> -->
                    <td><input type="text" name="username" placeholder="username" class="ms-5 pt-2 pb-2 ps-3" style="width: 100%;"></td>
                </tr>
                <!-- <br> -->
                <tr>
                    <!-- <td>Password</td> -->
                    <!-- <td>:</td> -->
                    <td><input type="text" name="password" required class="ms-5 pt-2 pb-2 ps-3 mt-3" style="width: 100%;" placeholder="password"></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" value="login" style="width:100%" class="ms-5 mt-3"></input></td>
                </tr>
            </table>
                            </div>
                            <div class="login_ordiv">
                                <div class="login_divider1"></div>
                                <div class="login_or">Or</div>
                                <div class="login_divider2"></div>
                            </div>
                            <div class="login_fb">
                                <img src="" width="15px">Log in with something else</div>
                            <!-- <div class="login_forgot">Forgot Password?</div> -->
                        
                        </div>

                        <div class="loginpage_signupoption">
                            <div class="loginpage_signin">
                                <!-- <br> -->
                                <p class="mt-3">Don't have an account? <a href="">Sign up</a></p>
                            </div>
                        </div>
                        </div>
                        </div>
            </div>
        </form>
    </div>
</body>
</html>