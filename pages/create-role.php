<?php
if (isset($_POST["simpan"])) {
    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $is_active = $_POST["is_active"];

    mysqli_query($koneksi, "INSERT INTO roles (name, description, is_active) VALUES ('$name', '$description', $is_active)");
    header("location:?page=role&status=success");
}


$id = $_GET["edit"] ?? '';

$query = mysqli_query($koneksi, "SELECT * FROM roles WHERE id='$id'");
$rEdit = mysqli_fetch_assoc($query);

if (isset($_POST["edit"])) {
    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $is_active = $_POST["is_active"];

    mysqli_query($koneksi, "UPDATE roles SET name='$name', description='$description', is_active='$is_active' WHERE id ='$id'");
    header("location:?page=role");
}
$status = $_GET["status"] ?? "";
?>

<div class="card">
    <h4 class="card-header">
        <?= isset($_GET["edit"]) ? "Edit" : "Create New" ?> Role
    </h4>
    <div class="card-body">
        <?php if ($status == 'password_not_match'): ?>
            <div class="alert alert-warning alert-dismissable fade show" role="alert">
                Password do not match
            </div>
        <?php endif ?>
        <?php if ($status == 'email_exists'): ?>
            <div class="alert alert-warning alert-dismissable fade show" role="alert">
                Email already exists
            </div>
        <?php endif ?>
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Name <?= $id ? "" : "*" ?></label>
                    <input type="text" class="form-control" name="name"
                        value="<?= isset($_GET["edit"]) ? $rEdit["name"] : '' ?>" placeholder="Enter Role Name"
                        required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Description <?= $id ? "" : "*" ?></label>
                    <textarea class="form-control" name="description"
                        value="<?= isset($_GET["edit"]) ? $rEdit["description"] : '' ?>"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Status <?= $id ? "" : "*" ?></label>
                    <input type="radio" name="is_active" value="1" <?= ($id && $rEdit["is_active"] == 1) ? "checked" : "" ?>> Active
                    <input type="radio" name="is_active" value="0" <?= ($id && $rEdit["is_active"] == 0) ? "checked" : "" ?>> Inactive
                </div>
                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-primary"
                        name="<?= isset($_GET["edit"]) ? "edit" : "simpan" ?>"><?= isset($_GET["edit"]) ? "Save changes" : "Save" ?></button>
                    <a href="?page=role" class="btn btn-secondary" name="">Cancel</a>
                </div>
        </form>
    </div>
</div>