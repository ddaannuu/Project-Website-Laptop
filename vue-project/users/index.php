<?php

require_once 'auth_check.php'; // Wajib login
require_once '../config/database.php';

// Ambil semua data user, diurutkan berdasarkan tanggal dibuat
try {
    $stmt = $conn->prepare("SELECT id, username, nama_lengkap, email, role, created_at FROM users ORDER BY created_at DESC");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Idealnya, log error ini daripada menampilkannya langsung
    $page_error = "Error mengambil data user: " . $e->getMessage();
    $users = []; // Kosongkan jika ada error
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header-nav">
            <h2>Manajemen User</h2>
            <div>
                <span>Halo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>) | </span>
                <a href="../index.php">Halaman Utama</a> |
                <a href="../auth/logout.php">Logout</a>
            </div>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success'; ?>">
                <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
            </div>
            <?php
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>
        
        <?php if (isset($page_error)): ?>
            <div class="errors"><p><?php echo htmlspecialchars($page_error); ?></p></div>
        <?php endif; ?>

        <p><a href="create.php" class="btn">Tambah User Baru</a></p>

        <?php if (count($users) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($user['role'])); ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y, H:i', strtotime($user['created_at']))); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn-edit">Edit</a>
                                <?php if ($_SESSION['user_id'] != $user['id']): // Jangan biarkan user hapus diri sendiri dari sini ?>
                                <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada user terdaftar.</p>
        <?php endif; ?>
    </div>
</body>
</html>