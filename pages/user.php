<?php
$selectUser = mysqli_query($koneksi, "SELECT * FROM users");
$rows = mysqli_fetch_all($selectUser, MYSQLI_ASSOC);
?>

<div class="card">
    <div class="card-header">
            <h2 class="card-title">Users</h2>
        <div class="card-body">
            <div class="mb-2">
                <a href="?page=user-create-edit" class="btn btn-primary">Create</a>
            </div>
            <div class="table-responsive">
                <?php
                if (isset($_GET["status"]) && $_GET["status"] == "success") {
                    $status = "Data Berhasil ditambah!";
                    $location = "?page=user";
                    echo statusSuccess($status, $location);
                }
                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $index => $r) {
                        ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td>
                                <a href="?page=user-create-edit&idEdit=<?= $r["id"] ?>" class="btn btn-success">Edit</a>
                                <form action="" method="post" class="d-inline">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <?php }?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>