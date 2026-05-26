<?php
if (isset($_POST["simpan"])) {
    $product_name = htmlspecialchars($_POST["product_name"]);
    $category_id = htmlspecialchars($_POST["category_id"]);
    $qty = htmlspecialchars($_POST["qty"]);
    $price = htmlspecialchars($_POST["price"]);
    $unit = htmlspecialchars($_POST["unit"]);
    $description = ($_POST["description"]);
    $is_active = $_POST["is_active"] ? 1 : 0;

    $product_image = time() . '_' . $_FILES["product_image"]["name"];
    $tmp_name = $_FILES["product_image"]["tmp_name"];
    move_uploaded_file($tmp_name, "assets/uploads/" . $product_image);

    mysqli_query($koneksi, "INSERT INTO products (category_id, product_name, qty, price, unit, description, is_active, product_image) VALUES ('$category_id','$product_name','$qty','$price','$unit','$description','$is_active', '$product_image')");
    header("location:?page=product&status=success");
}


$id = $_GET["edit"] ?? '';

$query = mysqli_query($koneksi, "SELECT * FROM products WHERE id='$id'");
$rEdit = mysqli_fetch_assoc($query);

$categories = mysqli_query($koneksi, "SELECT * FROM categories");
$rowCategories = mysqli_fetch_all($categories, MYSQLI_ASSOC);

if (isset($_POST["edit"])) {
    $id = htmlspecialchars($_POST["product_id"]);
    $product_name = htmlspecialchars($_POST["product_name"]);
    $category_id = htmlspecialchars($_POST["category_id"]);
    $qty = htmlspecialchars($_POST["qty"]);
    $price = htmlspecialchars($_POST["price"]);
    $unit = htmlspecialchars($_POST["unit"]);
    $description = ($_POST["description"]);
    $is_active = $_POST["is_active"] ? 1 : 0;


    if ($_FILES["product_image"]["name"] != '') {
        $product_image = time() . '_' . $_FILES["product_image"]["name"];
        $tmp_name = $_FILES["product_image"]["tmp_name"];
        if (file_exists("assets/uploads/" . $rEdit["product_image"]) && !empty($rEdit["product_image"])) {
            unlink("assets/uploads/" . $rEdit["product_image"]);
        }
        move_uploaded_file($tmp_name, "assets/uploads/" . $product_image);
    } else {
        $product_image = $rEdit["product_image"];
    }

    $cek = mysqli_query($koneksi, "SELECT product_name FROM products WHERE product_name='$product_name'");
    if (mysqli_num_rows($cek) > 0) {
        $update = mysqli_query($koneksi, "UPDATE products SET category_id='$category_id',product_image='$product_image',qty='$qty',price='$price',unit='$unit',description='$description',is_active='$is_active' WHERE id='$id'");
        header("location:?page=product");
        exit();
    }

    $update = mysqli_query($koneksi, "UPDATE products SET category_id='$category_id',product_image='$product_image',product_name='$product_name',qty='$qty',price='$price',unit='$unit',description='$description',is_active='$is_active' WHERE id='$id'");
    if ($update) {
        header("location:?page=product");
        exit();
    }

}
$status = $_GET["status"] ?? "";
?>

<div class="card">
    <h4 class="card-header">
        <?= isset($_GET["edit"]) ? "Edit" : "Create New" ?> Product
    </h4>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <?php if (isset($_GET["edit"])): ?>
                <input type="hidden" name="product_id" value="<?= $id ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="" class="form-label">Name <?= $id ? "" : "*" ?></label>
                <input type="text" class="form-control" name="product_name"
                    value="<?= isset($_GET["edit"]) ? $rEdit["product_name"] : '' ?>" placeholder="Enter Product Name"
                    required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category *</label>
                <select name="category_id" id="" class="form-select" required>
                    <option value="">Choose Category</option>
                    <?php foreach ($rowCategories as $key => $v) { ?>
                        <option value="<?= $v["id"] ?>" <?= isset($_GET["edit"]) && $rEdit["category_id"] == $v["id"] ? "selected" : "" ?>><?= $v["category_name"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Product Image <?= $id ? "" : "*" ?></label>
                <input type="file" class="form-control" name="product_image"
                    value="<?= isset($_GET["edit"]) ? $rEdit["product_image"] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Quantity <?= $id ? "" : "*" ?></label>
                <input type="number" class="form-control" name="qty"
                    value="<?= isset($_GET["edit"]) ? $rEdit["qty"] : '' ?>" placeholder="Enter Quantity" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Price <?= $id ? "" : "*" ?></label>
                <input type="number" class="form-control" name="price"
                    value="<?= isset($_GET["edit"]) ? $rEdit["price"] : '' ?>" placeholder="Enter Product Price"
                    required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Unit <?= $id ? "" : "*" ?></label>
                <input type="text" class="form-control" name="unit"
                    value="<?= isset($_GET["edit"]) ? $rEdit["unit"] : '' ?>" placeholder="Enter Product Unit" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description <?= $id ? "" : "*" ?></label>
                <textarea class="form-control" name="description"
                    value="<?= isset($_GET["edit"]) ? $rEdit["description"] : '' ?>"></textarea>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="is_active" <?= isset($_GET["edit"]) && $rEdit["is_active"] == 1 ? "checked" : "" ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                </div>
            </div>

            <div class="text-end mt-2">
                <button type="submit" class="btn btn-primary"
                    name="<?= isset($_GET["edit"]) ? "edit" : "simpan" ?>"><?= isset($_GET["edit"]) ? "Save changes" : "Save" ?></button>
                <a href="?page=product" class="btn btn-secondary" name="">Cancel</a>
            </div>
        </form>
    </div>
</div>