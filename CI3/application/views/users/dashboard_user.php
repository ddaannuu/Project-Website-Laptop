<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Admin</title>
    <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-12 col-md-3 col-lg-2 sidebar bg-primary text-white min-vh-100 p-3 d-flex flex-column">
      <div class="mb-4 d-flex align-items-center gap-3">
        <i class="bi bi-person-circle" style="font-size: 48px; color: #fff;"></i>
        <div>
          <h2 class="h5 fw-bold mb-1">Manajemen Admin</h2>
          <small class="text-light d-block">
            Halo, <?= htmlspecialchars($this->session->userdata('nama_lengkap')); ?><br>
            (<?= htmlspecialchars($this->session->userdata('role')); ?>)
          </small>
        </div>
      </div>
      <!-- Navigasi Sidebar -->
      <nav class="mt-3 flex-grow-1">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-primary border-0 p-0 mb-2">
            <a href="<?= site_url('index.php/products/manage'); ?>" class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded hover-bg-light">
              <i class="bi bi-box"></i> Manajemen Produk
            </a>
          </li>
          <li class="list-group-item bg-primary border-0 p-0 mb-2">
            <a href="http://localhost:5173/" class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded hover-bg-light">
              <i class="bi bi-house"></i> Halaman Utama
            </a>
          </li>
          <li class="list-group-item bg-primary border-0 p-0 mb-2">
            <a href="<?= base_url('index.php/auth/logout'); ?>" class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded hover-bg-light">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </nav>
    </nav>

    <!-- Main content -->
    <main class="col-12 col-md-9 col-lg-10 p-4">

      <!-- Tabel data user -->
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-primary">
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
                <td><?= htmlspecialchars($user['id']); ?></td>
                <td><?= htmlspecialchars($user['username']); ?></td>
                <td><?= htmlspecialchars($user['nama_lengkap']); ?></td>
                <td><?= htmlspecialchars($user['email']); ?></td>
                <td><?= ucfirst($user['role']); ?></td>
                <td><?= date('d M Y, H:i', strtotime($user['created_at'])); ?></td>
                <td>
                  <a href="<?= site_url('index.php/users/edit/' . $user['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                  <?php if ($this->session->userdata('user_id') != $user['id']): ?>
                    <a href="<?= site_url('index.php/users/delete/' . $user['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user?')">Hapus</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Tombol di bawah tabel -->
      <div class="mt-3 d-flex justify-content-end">
        <a href="<?= site_url('index.php/users/create'); ?>" class="btn btn-success">Tambah Admin Baru</a>
      </div>

    </main>
  </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
