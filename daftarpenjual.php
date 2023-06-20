<?php
    session_start();
    include("connection.php");

    // Registration Logic
    if(isset($_POST["submit"])){
        $nokp=$_POST["nokp"];
        $namapenjual=$_POST["namapenjual"];
        $katalaluan=$_POST["katalaluan"];
        $email=$_POST["email"];
        $seller = 1;

        // Check if the user already exists in the penjual table
        $sql='SELECT * FROM penjual';
        $result = mysqli_query($con, $sql);
        while($penjual=mysqli_fetch_array($result)){
            if($penjual["nokp"]==$nokp){
                echo"<script>alert('User already exists')</script>";
                echo"<script>window.location='index.php'</script>";
                break;
            }
        }

        // Insert the new user into the penjual table
        $sql="INSERT INTO penjual VALUES ('$nokp','$namapenjual','$katalaluan','$email','$seller')";
        $result=mysqli_query($con,$sql);

        // Display success or error message based on the query result
        if($result)
            echo"<script>alert('Sign Up Successful!')</script>";
        else
            echo"<script>alert('Error. Please try again!')</script>";

        echo"<script>window.location='daftarpenjual.php'</script>";
    }

    // Login Logic
    else if(isset($_POST["submit2"])){
        $nokp=$_POST["nokp"];
        $katalaluan=$_POST["katalaluan"];
        $email=$_POST["email"];
        $jumpa=FALSE;

        // Check if the user is an admin
        if($jumpa==FALSE){
            $sql='SELECT * FROM lycoadmin';
            $result = mysqli_query($con, $sql);
            while($admin=mysqli_fetch_array($result)){
                if($admin["idadmin"]==$nokp && $admin["katalaluan"]==$katalaluan && $admin["email"]==$email){
                    $jumpa=TRUE;
                    $_SESSION["nokp"]= $admin["idadmin"];
                    $_SESSION["namapenjual"]= $admin["namaadmin"];
                    $_SESSION["status"]="admin";
                    break;
                }
            }
        }

        // Check if the user is a penjual
        if($jumpa==FALSE){
            $sql='SELECT * FROM penjual';
            $result = mysqli_query($con, $sql);
            while($penjual=mysqli_fetch_array($result)){
                if($penjual["nokp"]==$nokp && $penjual["katalaluan"]==$katalaluan && $penjual["seller"]== 1){
                    $jumpa=TRUE;
                    $_SESSION["nokp"]= $penjual["nokp"];
                    $_SESSION["namapenjual"]= $penjual["namapenjual"];
                    $_SESSION["status"]="penjual";
                    break;
                }
            }
        }

        // Redirect the user based on their role (admin or penjual)
        if($jumpa==TRUE){
            if ($_SESSION["status"]=="penjual"){
                echo"<script>alert('Logged In Successfully')</script>";
                echo"<script>window.location='penjual_home.php'</script>";
            } else if ($_SESSION["status"]=="admin") {
                echo"<script>alert('Admin Logged In')</script>";
                echo"<script>window.location='admin.php'</script>";
            }
        }

        // Display error message if the user is not found
        if($jumpa==FALSE){
            echo"<script>alert('Please Check Your Username or Password')</script>";
            echo"<script>window.location='daftarpenjual.php'</script>";
        }
    }
?>

<title>Join Us Now!!</title>
<link rel="stylesheet" href="style/aborang.css">
<link rel="stylesheet" href="style/abutton.css">
<link rel="stylesheet" href="style/font.css">
<body>
    <center><br>
    <a href="pembeli_home.php">
        <img src="imej/tajuk.png">
    </a>
    </center>
    <h3 style="font-family: Audiowide, sans-serif;">SELLER CENTRE</h3>
    <form action="daftarpenjual.php" method="post">
        <center>
            <table>
                <tr>
                    <td>IC Number</td>
                    <td><input required type="text"
                        name="nokp" placeholder="************"
                        pattern="[0-9]{12}"
                        oninvalid="this.setCustomValidity('Please enter 12 number without - ')"
                        oninput="this.setCustomValidity('')">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="namapenjual"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="katalaluan"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email"></td>
                </tr>
            </table>

            <button class="round" type="submit2" name="submit2">Log In</button>
            <button class="round" type="submit" name="submit">Sign Up</button>
            <button class="round" type="button" onclick="window.location='pembeli_home.php'">Back</button>
    </form>
    </center>
</body>
