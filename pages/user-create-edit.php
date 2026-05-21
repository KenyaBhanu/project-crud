<?php
if (isset($_POST["simpan"])) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["password-confirm"];
    $passSha = sha1($password);

    if ($password !== $confirm_password) {
        header("location:?page=user-create-edit&status=password_not_match");
        exit();
    }

    $cekEmail = mysqli_query($koneksi, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($cekEmail) > 0) {
        header("location:?page=user-create-edit&status=email_exists");
        exit();
    }

    mysqli_query($koneksi, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$passSha')");
    header("location:?page=user-create-edit&status=success");
}

$id = $_GET["idEdit"] ?? '';

$selectUser = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
$rEdit = mysqli_fetch_assoc($selectUser);

if (isset($_POST["edit"])) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $pasword = $_POST["password"];
    $confirm_password = $_POST["password-confirm"];
    $passSha = sha1($password);

    if (empty($password)) {
        mysqli_query($koneksi, "UPDATE users SET name='$name', email='$email' WHERE id ='$id'");
        header("location:?page=user");
        exit();
    }
    if ($password !== $confirm_password) {
        header("location?:page=user-create-edit&idEdit=" .$id. "&status=password_not_match");
        exit();
    }
    mysqli_query($koneksi, "UPDATE users SET name='$name', email='$email', password='$passSha' WHERE id ='$id'");
    header("location:?page=user");
}

$status = $_GET["status"] ?? "";
?>

<div class="card">
    <h4 class="card-header">
        <?= isset($_GET["idEdit"]) ? "Edit" : "Create New" ?> User
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
                        value="<?= isset($_GET["idEdit"]) ? $rEdit["name"] : '' ?>" placeholder="Enter Your Name"
                        required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Email <?= $id ? "" : "*" ?></label>
                    <input type="email" class="form-control" name="email"
                        value="<?= isset($_GET["idEdit"]) ? $rEdit["email"] : '' ?>"
                        placeholder="Example: admin@gmail.com" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Password <?= $id ? "" : "*" ?></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" <?= $id ? "": "required" ?>>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Password Confirm <?= $id ? "" : "*" ?></label>
                    <input type="password" class="form-control" name="password-confirm" placeholder="Confirm Password"
                        <?= $id ? "" : "required" ?>>
                </div>
            </div>
            <?php if ($id): ?>
            <div class="mt-2 text-secondary">
                <p>Leave blank if you don't want to change the password</p>
            </div>
            <?php endif ?>
            <div class="text-end mt-2">
                <button type="submit" class="btn btn-primary"
                    name="<?= isset($_GET["idEdit"]) ? "edit" : "simpan" ?>"><?= isset($_GET["idEdit"]) ? "Save changes" : "Save" ?></button>
                <a href="?page=user" class="btn btn-secondary" name="">Cancel</a>
            </div>
        </form>
    </div>
</div>