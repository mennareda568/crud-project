<?php
include("users.php");
if (isset($_SESSION['userlogin'])) {

    $page = "All";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    if ($page == "All") {
        $statment = $connect->prepare("select * from categories");
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
                            header("refresh:20;url=index.php");
                        }
                        ?>
                        <h4 class="text-center mb-4">NUMBER OF CATEGORIES
                            <span class="badge badge-primary"><?php echo $usercount ?></span>
                        </h4>
                        <table class="table table-striped table-dark ">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $item) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $item['category_id'] ?></th>
                                        <td><?php echo $item['title'] ?></td>
                                        <td><?php echo $item['description'] ?></td>
                                        <td>
                                            <a href="?page=show&category_id=<?php echo $item['category_id'] ?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
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
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        }
        $statment = $connect->prepare("select * from categories where category_id =?");
        $statment->execute(array($category_id));
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
                                <th scope="col">Description</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $item['category_id'] ?></th>
                                <td><?php echo $item['title'] ?></td>
                                <td><?php echo $item['description'] ?></td>
                                <td><?php echo $item['created_at'] ?></td>
                                <td><?php echo $item['updated_at'] ?></td>
                                <td>
                                    <a href="index.php" class="btn btn-success"><i class="fa-solid fa-house"></i></a>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    } 

} else {
    $_SESSION['message'] = "Please Login First";
    header("Location:login.php");
}
?>
