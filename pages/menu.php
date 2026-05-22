<?php
$query = mysqli_query($koneksi, "SELECT parent.name as parent_name, menus.* FROM menus LEFT JOIN menus as parent ON parent.id = menus.parent_id ORDER by menus.id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET["delete"])) {
    $id = $_GET["delete"] ?? 0;
    $delete = mysqli_query($koneksi, "DELETE FROM menus WHERE id='$id'");
    header("location:?page=menu");
    exit();
}

?>
<div class="card">
    <h4 class="card-header">
        Manage Menus
    </h4>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=create-menu" class="btn btn-primary">Create New Menu</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET["status"]) && $_GET["status"] == "success") {
                $status = "Menu created successfully!";
                $location = "?page=menu";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Parent</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Sort Order</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                        ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $r['parent_name'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['url'] ?></td>
                            <td><i class="menu-icon tf-icons bx <?= $r['icon'] ?>"></i><?= $r['icon'] ?></td>
                            <td><?= $r['sort_order'] ?></td>
                            <td><?= getStatus($r['is_active']) ?></td>
                            <td>
                                <a href="?page=create-menu&edit=<?= $r["id"] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=menu&delete=<?= $r['id'] ?>" method="post" class="d-inline">
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