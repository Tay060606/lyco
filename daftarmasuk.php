<?php 
    include("connection.php"); // Include the connection file to establish database connection

    if(isset($_POST["submit"])){ // Check if the form is submitted
        $nokp=$_POST["nokp"]; 
        $namapembeli=$_POST["namapembeli"]; 
        $katalaluan=$_POST["katalaluan"]; 
        $spent = 0.00;

        // Check if the user ID already exists in the database
        $check_query = "SELECT * FROM pembeli WHERE nokp = '$nokp'";
        $check_result = mysqli_query($con, $check_query);
        $num_rows = mysqli_num_rows($check_result);
        
        if ($num_rows > 0) {
            echo "<script>alert('The User ID has been used');</script>";
        } else {
            // Prepare and execute the SQL statement to insert a new user
            $stmt = mysqli_prepare($con, "INSERT INTO pembeli values(?, ?, ?, ?)"); 
            mysqli_stmt_bind_param($stmt, "ssss", $nokp, $namapembeli, $katalaluan, $spent); 
            mysqli_stmt_execute($stmt); 
            $result = mysqli_stmt_affected_rows($stmt); 
            mysqli_stmt_close($stmt); 

            if($result) 
                echo"<script>alert('Signed up successfully.')</script>"; 
            else 
                echo"<script>alert('Sign up failed.')</script>"; 

            echo"<script>window.location='index.php'</script>"; // Redirect to another page after successful signup
        }
    } 
?>

<title>Sign Up Now!!</title>
<link rel="stylesheet" href="style/aborang.css"> <!-- External stylesheet for custom styling -->
<link rel="stylesheet" href="style/abutton.css"> <!-- External stylesheet for custom styling -->
<link rel="stylesheet" href="style/font.css"> <!-- External stylesheet for custom styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Comfortaa:wght@700&display=swap">

<body>
    <center><br>
        <a href="pembeli_home.php">
            <img src="imej/tajuk.png">
        </a>
    </center>
    <h3 style="font-family: Audiowide, sans-serif;">SIGN UP</h3>
    <form action="daftarmasuk.php" method="post">
        <center>
            <table>
                <tr>
                    <td>IC Number</td>
                    <td>
                        <input required type="text" name="nokp" placeholder="************" pattern="[0-9]{12}"
                            oninvalid="this.setCustomValidity('Please enter 12 numbers without - ')"
                            oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input required type="text" name="namapembeli"
                            oninvalid="this.setCustomValidity('Please enter your name')"
                            oninput="this.setCustomValidity('')">
                    </td>

                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input required type="password" name="katalaluan"
                            oninvalid="this.setCustomValidity('Please enter your password')"
                            oninput="this.setCustomValidity('')">
                    </td>
                </tr>
            </table>

            <button class="round" type="submit" name="submit">Sign Up</button>
            <button class="round" type="reset">Reset</button>
            <button class="round" type="button" onclick="window.location='index.php'">Log In</button>
        </center>
    </form>
</body>
