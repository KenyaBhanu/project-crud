<?php
if (isset($_POST["simpan"])) {
    $parent_id = ($_POST["parent_id"]) ?? 'NULL';
    $name = htmlspecialchars($_POST["name"]);
    $url = ($_POST["url"]);
    $icon = ($_POST["icon"]);
    $sort_order = ($_POST["sort_order"]);
    $is_active = $_POST["is_active"];

    mysqli_query($koneksi, "INSERT INTO menus(parent_id, name, url, icon, sort_order, is_active) VALUES ($parent_id,'$name','$url','$icon','$sort_order','$is_active')");
    header("location:?page=menu&status=success");
}


$id = $_GET["edit"] ?? '';

$query = mysqli_query($koneksi, "SELECT * FROM menus WHERE id='$id'");
$rEdit = mysqli_fetch_assoc($query);

if (isset($_POST["edit"])) {
    $parent_id = ($_POST["parent_id"]) ?? 'NULL';
    $name = htmlspecialchars($_POST["name"]);
    $url = ($_POST["url"]);
    $icon = ($_POST["icon"]);
    $sort_order = ($_POST["sort_order"]);
    $is_active = $_POST["is_active"];

    mysqli_query($koneksi, "UPDATE `menus` SET parent_id=$parent_id,name='$name',url='$url',icon='$icon',sort_order='$sort_order',is_active='$is_active' WHERE id='$id'");
    header("location:?page=menu");
}

$queryParent = mysqli_query($koneksi, "SELECT * FROM menus WHERE parent_id IS NULL");
$rowParent =mysqli_fetch_all($queryParent, MYSQLI_ASSOC);
?>

<div class="card">
    <h4 class="card-header">
        <?= isset($_GET["edit"]) ? "Edit" : "Create New" ?> Menu
    </h4>
    <div class="card-body">
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Parent ID
                    </label>
                    <select name="parent_id" id="" class="form-control">
                        <option value="NULL">Select One</option>
                        <?php foreach ($rowParent as $row) {
                        ?> <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Name
                        <?= $id ? "" : "*" ?>
                    </label>
                    <input type="text" class="form-control" name="name"
                        value="<?= isset($_GET["edit"]) ? $rEdit["name"] : '' ?>" placeholder="Enter Menu Name"
                        required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">URL
                    </label>
                    <input type="text" class="form-control" name="url"
                        value="<?= isset($_GET["edit"]) ? $rEdit["url"] : '' ?>" placeholder="Enter URL">
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Icon
                        <?= $id ? "" : "*" ?>
                    </label>
                    <input type="text" class="form-control" name="icon"
                        value="<?= isset($_GET["edit"]) ? $rEdit["icon"] : '' ?>" placeholder="Enter Icon Class Name">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Sort Order
                        <?= $id ? "" : "*" ?>
                    </label>
                    <input type="text" class="form-control" name="sort_order"
                        value="<?= isset($_GET["edit"]) ? $rEdit["sort_order"] : '' ?>" placeholder="Enter Sort Order">
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Status
                        <?= $id ? "" : "*" ?>
                    </label><br>
                    <input type="radio" name="is_active" value="1" <?= ($id && $rEdit["is_active"] == 1) ? "checked" : "" ?>>
                    Active <br>
                    <input type="radio" name="is_active" value="0" <?= ($id && $rEdit["is_active"] == 0) ? "checked" : "" ?>>
                    Inactive
                </div>
            </div>
            <div class="text-end mt-2">
                <button type="submit" class="btn btn-primary" name="<?= isset($_GET["edit"]) ? "edit" : "simpan" ?>">
                    <?= isset($_GET["edit"]) ? "Save changes" : "Save" ?>
                </button>
                <a href="?page=menu" class="btn btn-secondary" name="">Cancel</a>
            </div>
        </form>
    </div>
</div>