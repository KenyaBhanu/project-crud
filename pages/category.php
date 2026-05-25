<?php
$query = mysqli_query($koneksi, "SELECT * FROM categories");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET["delete"])) {
    $id = $_GET["delete"] ?? 0;
    $delete = mysqli_query($koneksi, "DELETE FROM categories WHERE id='$id'");
    header("location:?page=category");
    exit();
}

?>

<div class="card">
    <h4 class="card-header">Manage Category</h4>
    <div class="card-body">
        <div class="mb-2 d-flex justify-content-end" align="right">
            <a href="?page=create-category" class="btn btn-primary">Create Category</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET["status"]) && $_GET["status"] == "success") {
                $status = "Menu created successfully!";
                $location = "?page=category";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                        ?>
                        <tr>
                            <td>
                                <?= $index + 1 ?>
                            </td>
                            <td>
                                <?= $r['category_name'] ?>
                            </td>
                            <td>
                                <a href="?page=create-category&edit=<?= $r["id"] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=category&delete=<?= $r['id'] ?>" method="post" class="d-inline">
                                    <button class="btn btn-danger" onclick="return confirm('YAKIN?')">Delete</button>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>