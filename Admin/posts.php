<?php
include("initials.php");
if (isset($_SESSION['login'])) {

    $page = "All";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    if ($page == "All") {
        $statment = $connect->prepare("select * from posts");
        $statment->execute();
        $usercount = $statment->rowcount();
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
                            header("refresh:3;url=posts.php");
                        }
                        ?>
                        <h4 class="text-center mb-4">NUMBER OF ARTICLES
                            <span class="badge badge-primary"><?php echo $usercount ?></span>
                        </h4>
                        <table class="table table-striped table-dark ">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Status</th>
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
                                        <td><?php echo $item['status'] ?></td>
                                        <td>
                                            <a href="?page=show&post_id=<?php echo $item['post_id'] ?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                            <a href="?page=edit&post_id=<?php echo $item['post_id'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="?page=delete&post_id=<?php echo $item['post_id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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

    } else if ($page == "show") {
        if (isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        $statment = $connect->prepare("select * from posts where post_id =?");
        $statment->execute(array($post_id));
        $item = $statment->fetch();
    ?>

        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Status</th>
                                <th scope="col">User_id</th>
                                <th scope="col">Category_id</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $item['post_id'] ?></th>
                                <td><?php echo $item['title'] ?></td>
                                <td><?php echo $item['description'] ?></td>
                                <td><?php echo $item['status'] ?></td>
                                <td><?php echo $item['user_id'] ?></td>
                                <td><?php echo $item['category_id'] ?></td>
                                <td><?php echo $item['created_at'] ?></td>
                                <td><?php echo $item['updated_at'] ?></td>
                                <td>
                                    <a href="posts.php" class="btn btn-success"><i class="fa-solid fa-house"></i></a>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    <?php
    } else if ($page == "delete") {
        if (isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        $statment = $connect->prepare("delete from posts where  post_id=?");
        $statment->execute(array($post_id));
        $_SESSION['message'] = "deleted sucessfully";
        header("Location:posts.php");
    }  else if ($page == "edit") {
        if (isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        $statment = $connect->prepare("select * from posts where post_id=?");
        $statment->execute(array($post_id));
        $result = $statment->fetch();
    ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <h4 class="text-center mt-4">UPDATE ARTICLE PAGE</h4>
                    <form action="?page=saveupdate" method="post">
                        <input type="hidden" name="oldid" value="<?php echo $result['post_id'] ?>" class="form-control mb-4">
                        <label>STATUS</label>
                        <select name="status" class="form-control mb-4">
                            <?php
                            if ($result['status'] == "1") {
                                echo '<option value="1" selected>active</option>';
                                echo  '<option value="0">block</option>';
                            } else {
                                echo '<option value="1" >active</option>';
                                echo  '<option value="0" selected>block</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" class="form-control  btn btn-success" value="UPDATE POST">
                    </form>
                </div>
            </div>
        </div>
    <?php
    } else if ($page == "saveupdate") {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $oldid = $_POST['oldid'];
            $status = $_POST['status'];
        }
        try {
            $statment = $connect->prepare("UPDATE posts
        SET `status`=?,updated_at=now()
        WHERE post_id=?");
            $statment->execute(array($status, $oldid));
            $_SESSION['message'] = "UPDATED SUCESSFULLY";
            header("Location:posts.php");
        } catch (PDOException $e) {
            header("Refresh:3;url=posts.php?page=edit&post_id=$oldid");
        }
    }
    ?>


<?php
} else {
    $_SESSION['message'] = "Please Login First";
    header("Location:../login.php");
}
include("Includes/temp/footer.php");
?>
