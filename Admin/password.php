<?php
include("initials.php");
session_start();
if (isset($_SESSION['login'])) {

    $email = $_SESSION['login'];

    $statment1 = $connect->prepare("SELECT * FROM users WHERE email =?");
    $statment1->execute(array($email));
    $item = $statment1->fetch();

    $user_id = $item['user_id'];


    $page = "All";
    if ($page == "All") {
        $statment1 = $connect->prepare("SELECT * FROM users");
        $statment1->execute();
        $result = $statment1->fetchall();
    }
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    

    $statment1 = $connect->prepare("SELECT * FROM users WHERE	user_id =?");
    $statment1->execute(array($user_id));
    $item = $statment1->fetch();

?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mt-5">
                <form action="?page=password" method="post">
                    <input type="hidden" name="old_id" value="<?php echo $item['user_id']; ?>" class="form-control mb-3 ">
                    <input type="password" name="pass" class="form-control mb-3">
                    <input type="submit" value="Update" class="form-control mt-3 btn btn-success ">
                </form>
            </div>
        </div>
    </div>
<?php
    if ($page == "password") {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $old_id = $_POST['old_id'];
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            try {
                $statment = $connect->prepare("UPDATE USERS SET 
           `password`=?,
            updated_at=now() 
            WHERE user_id=?");
                $statment->execute(array($pass, $old_id));
                $_SESSION['message'] = "UPDATED SUCESSFULLY";
                header("Location:users.php");
            } catch (PDOException $e) {
                $_SESSION['message'] = "Error: " . $e->getMessage();
                header("Location:users.php");
            }
        }
    }
} else {
    $_SESSION['message'] = "Please Login First";
    header("Location:../login.php");
}
include("Includes/temp/footer.php");
?>
