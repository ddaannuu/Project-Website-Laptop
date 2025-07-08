<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
</head>
<body>
<div class="container">
    <div class="header-nav">
        <h2>Tambah User Baru</h2>
        <div>
            <a href="<?php echo site_url('index.php/users/dashboard_user'); ?>">Kembali ke Manajemen User</a>
        </div>
    </div>

    <?php if ( ! empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" class="btn">Simpan</button>
    </form>
</div>
</body>
</html>
