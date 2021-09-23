<html>
    <body>
        <?php 

        //class loginTest extends \PHPUnit\Framework\TestCase{
            $conn = new mysqli("localhost", "root", "","food-project" );
            if ($conn->connect_error){
                die("connection failed". $conn->connect_error);
            }
            $sql = "SELECT * FROM tbl_admin";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row(result);

            while($queryRow = $result->fetch_row()){
                echo "";
                for($i = 0; $i < $result->field_count ; $i++){
                    echo queryRow[$i];
                }
                echo " ";
            }
            echo implode(" ",$row);


            



        //}
        ?>
    </body>
</html>