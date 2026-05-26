<?php
$query = mysqli_query($koneksi, "SELECT products.*, categories.category_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY id DESC");
// "SELECT users.name, users.email, users.id FROM users" untuk mengambil hanya name email dan id agar tidak berat jika data banyak
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET["delete"])) {
    $id = $_GET["delete"] ?? 0;
    $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id='$id'");
    header("location:?page=product");
    exit();
}

?>
<div class="card">
    <h4 class="card-header">
        Manage Products
    </h4>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=create-product" class="btn btn-primary">Create New Product</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET["status"]) && $_GET["status"] == "success") {
                $status = "Product created successfully!";
                $location = "?page=product";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                        ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><img src="assets/uploads/<?= $r['product_image'] ?>" alt="" width="150"></td>
                            <td><?= $r['product_name'] ?></td>
                            <td><?= $r['category_name'] ?></td>
                            <td><?= $r['qty'] ?></td>
                            <td><?= $r['unit'] ?></td>
                            <td>Rp. <?= number_format($r['price'], 2, ',', '.') ?></td>
                            <td><?= $r['description'] ?></td>
                            <td><?= getStatus($r['is_active']) ?></td>
                            <td>
                                <a href="?page=create-product&edit=<?= $r["id"] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=product&delete=<?= $r['id'] ?>" method="post" class="d-inline">
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>