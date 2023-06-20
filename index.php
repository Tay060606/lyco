<?php
    session_start();

    include("connection.php");

    if(isset($_POST["submit"])){
        $nokp=$_POST["nokp"];
        $katalaluan=$_POST["katalaluan"];
        $jumpa=FALSE;

        if($jumpa==FALSE){
            $sql="SELECT * FROM pembeli";
            $result = mysqli_query($con, $sql);
            while($pembeli=mysqli_fetch_array($result)){
                if($pembeli["nokp"]== $nokp && $pembeli["katalaluan"]==$katalaluan){
                    $jumpa=TRUE;
                    $_SESSION["nokp"]= $pembeli["nokp"];
                    $_SESSION["nama"]= $pembeli["namapembeli"];
                    $_SESSION["status"]="pembeli";
                    break; 
                }
            }
        }
        
        if($jumpa==FALSE){
            $sql='SELECT * FROM penjual';
            $result = mysqli_query($con, $sql);
            while($penjual=mysqli_fetch_array($result)){
                if($penjual["nokp"]==$nokp && $penjual["katalaluan"]==$katalaluan && $penjual["seller"]==1){
                    $jumpa=TRUE;
                    $_SESSION["nokp"]= $penjual["nokp"];
                    $_SESSION["namapenjual"]= $penjual["namapenjual"];
                    $_SESSION["katalaluan"]= $penjual["katalaluan"];
                    $_SESSION["status"]="penjual";
                    break; 
                }
            }
        }
        
        if($jumpa==TRUE){
            if($_SESSION["status"]=="pembeli"){
                echo"<script>alert('Logged In Successfully')</script>";
                echo"<script>window.location='pembeli_home.php'</script>";
            } else if ($_SESSION["status"]=="penjual"){
                echo"<script>alert('Logged In Successfully')</script>";
                echo"<script>window.location='penjual_home.php'</script>";
            }
        }
        if($jumpa==FALSE){
            echo"<script>alert('Please Check Your Username or Password')</script>";
            echo"<script>window.location='index.php'</script>";
        }
    }
    ?>
    <title>Welcome Back, Lycoris</title>
    <link rel="stylesheet" href="style/aborangI.css">
    <link rel="stylesheet" href="style/abutton.css">
    <link rel="stylesheet" href="style/font.css">

        
    <center>
    <a href="pembeli_home.php">
        <img class="tajuk" src="imej/tajuk.png" alt="Clickable Image">
    </a>
    </center>

    <h3 style = "font-family: Audiowide, sans-serif;">LOG IN</h3>
    <form action="index.php" method="post">
            <center>
            <table>
                <tr>
                    <td><img src="imej/user.png"></td>
                    <td><input required type="text" name="nokp" placeholder="IC Number"></td>
                </tr>
                <tr>
                    <td><img src="imej/lock.png"></td>
                    <td><input type="password" name="katalaluan" placeholder="Password"></td>
                </tr>
                </table>
                </center>
                <button class="round" type="submit" name="submit">Login</button>
                <button class="round" type="button" onclick="window.location='daftarmasuk.php'">Sign Up</button>
</form>