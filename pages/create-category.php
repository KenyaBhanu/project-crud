<?php
if (isset($_POST["simpan"])) {
    $category_name = htmlspecialchars($_POST["category_name"]);

    $cekNama = mysqli_query($koneksi, "SELECT category_name FROM categories WHERE category_name='$category_name'");

    if (mysqli_num_rows($cekNama) > 0) {
        header("location:?page=create-category&status=category_exists");
        exit();
    }

    mysqli_query($koneksi, "INSERT INTO categories (category_name) VALUES ('$category_name')");
    header("location:?page=category&status=success");
}


$id = $_GET["edit"] ?? '';

$query = mysqli_query($koneksi, "SELECT * FROM categories WHERE id='$id'");
$rEdit = mysqli_fetch_assoc($query);

if (isset($_POST["edit"])) {
    $category_name = htmlspecialchars($_POST["category_name"]);

    mysqli_query($koneksi, "UPDATE categories SET category_name='$category_name' WHERE id ='$id'");
    header("location:?page=category");
}
$status = $_GET["status"] ?? "";
?>

<div class="card">
    <h4 class="card-header">
        <?= isset($_GET["edit"]) ? "Edit" : "Create New" ?> Category
    </h4>
    <div class="card-body">
        <?php if ($status == 'category_exists'): ?>
            <div class="alert alert-warning alert-dismissable fade show" role="alert">
                Category already exists
            </div>
        <?php endif ?>
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Name <?= $id ? "" : "*" ?></label>
                    <input type="text" class="form-control" name="category_name"
                        value="<?= isset($_GET["edit"]) ? $rEdit["category_name"] : '' ?>" placeholder="Enter Category Name"
                        required>
                </div>
                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-primary"
                        name="<?= isset($_GET["edit"]) ? "edit" : "simpan" ?>">
                        <?= isset($_GET["edit"]) ? "Save changes" : "Save" ?>
                    </button>
                    <a href="?page=category" class="btn btn-secondary" name="">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>