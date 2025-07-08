<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
</head>
<body>
<div class="container">
    <div class="header-nav">
        <h2>Edit User</h2>
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
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Password (kosongkan jika tidak diubah):</label>
        <input type="password" name="password">

        <label>Role:</label>
        <select name="role" required>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select>

        <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>
