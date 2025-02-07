<?php
include("users.php");
if (isset($_SESSION['loginuser'])) {

    $email = $_SESSION['loginuser'];
    $statment1 = $connect->prepare("SELECT * FROM users WHERE email =?");
    $statment1->execute(array($email));
    $item = $statment1->fetch();
    $_SESSION['userlogin_id'] = $item['user_id'];


        $page = "All";
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if ($page == "All") {
            $statment = $connect->prepare("select * from posts where status='1' ");
            $statment->execute();
            $result = $statment->fetchall();

    ?>
    
            <div class="container mt-5 ">
                <div class="row">
                    <div class="col-md-10 m-auto pt-5">
                        <div>
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo "<h4 class='text-center alert alert-success'>" . $_SESSION['message'] . "</h4>";
                                unset($_SESSION['message']);
                                header("refresh:20;url=posts.php");
                            }
                            ?>
                            <h4 class="text-center mb-4">ARTICLES
                            </h4>
                            <table class="table table-striped table-dark ">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $item) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $item['post_id'] ?></th>
                                            <td><?php echo $item['title'] ?></td>
                                            <td><?php echo $item['description'] ?></td>
           
                                            <td>
                                                <a href="?page=report&user_id=<?php echo $item['user_id'] ?>" class="btn btn-danger"><i class="fa-solid fa-flag"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
    
                                    ?>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    
        <?php
    
        } else if ($page == "report") {
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
            }
            $statment = $connect->prepare("select * from reports where user_id =?");
            $statment->execute(array($user_id));
            $item = $statment->fetch();
        ?>

            <div class="container mt-5">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <h4 class="text-center mt-4">REPORT PAGE</h4>
                    <form action="?page=savereport" method="post">
                        <input type="hidden" name="oldid" value="<?php echo $item['user_id'] ?>" class="form-control mb-4">
                        <input type="text" name="report" class="form-control mb-4">
                        <input type="submit" class="form-control  btn btn-success" value="REPORT POST">
                    </form>
                </div>
            </div>
        </div>
        
    
        <?php
    } else if ($page == "savereport") {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $oldid = $_POST['oldid'];
            $report = $_POST['report'];
        }

            $statment = $connect->prepare("UPDATE reports
        SET report=?,created_at=now()
        WHERE id=?");
            $statment->execute(array( $report,$oldid));
            $_SESSION['message'] = "Your report was sent sucessfully";
            header("Location:userindex.php");
        
    }
    ?>
   <?php     
} else {
    $_SESSION['message'] = "Please Login First";
    header("Location:login.php");
}
?>



