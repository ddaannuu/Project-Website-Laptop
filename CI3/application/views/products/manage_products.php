<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Produk</title>
  <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
</head>
<body class ="manage">
<div class="container-manage">
  <div class="header-nav">
    <h2>Manajemen Produk</h2>
    <div>
      <span>Halo, <?php echo htmlspecialchars($this->session->userdata('nama_lengkap')); ?> (<?php echo htmlspecialchars($this->session->userdata('role')); ?>) | </span>
      <a href="http://localhost:5173/">Halaman Utama</a>
    </div>
  </div>

  <?php if ($this->input->get('deleted')): ?>
    <div class="message success">Produk berhasil dihapus.</div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="errors"><?php echo $error; ?></div>
  <?php endif; ?>

  <p><a href="<?php echo site_url('index.php/products/create_form'); ?>" class="btn">Tambah Produk Baru</a></p>

  <!-- ========== NEW ARRIVAL ========== -->
  <h3>Produk New Arrival</h3>
  <?php if (count($products) > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Slug</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
          <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['title']); ?></td>
            <td><?php echo htmlspecialchars($p['slug']); ?></td>
            <td>Rp<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
            <td><?php echo $p['status']; ?></td>
            <td><?php echo $p['created_at']; ?></td>
            <td>
              <a href="<?php echo site_url('index.php/products/edit/' . $p['id'] . '?type=products'); ?>" class="btn-edit">Edit</a>
              <a href="<?php echo site_url('index.php/products/delete/' . $p['id'] . '?type=products'); ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Belum ada produk New Arrival.</p>
  <?php endif; ?>

  <!-- ========== BEST SELLER ========== -->
  <h3>Produk Best Seller</h3>
  <?php if (count($best_sellers) > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Slug</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($best_sellers as $p): ?>
          <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['title']); ?></td>
            <td><?php echo htmlspecialchars($p['slug']); ?></td>
            <td>Rp<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
            <td><?php echo $p['status']; ?></td>
            <td><?php echo $p['created_at']; ?></td>
            <td>
              <a href="<?php echo site_url('index.php/products/edit_best_seller/' . $p['id']); ?>" class="btn-edit">Edit</a>

              <a href="<?php echo site_url('index.php/products/delete/' . $p['id'] . '?type=best_seller'); ?>"
 class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk best seller ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Belum ada produk Best Seller.</p>
  <?php endif; ?>

  <!-- ========== ON SALE ========== -->
  <h3>Produk On Sale</h3>
  <?php if (count($on_sales) > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Slug</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($on_sales as $p): ?>
          <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['title']); ?></td>
            <td><?php echo htmlspecialchars($p['slug']); ?></td>
            <td>Rp<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
            <td><?php echo $p['status']; ?></td>
            <td><?php echo $p['created_at']; ?></td>
            <td>
              <a href="<?php echo site_url('index.php/products/edit_on_sale/' . $p['id'] . '?type=on_sale'); ?>" class="btn-edit">Edit</a>
              <a href="<?php echo site_url('index.php/products/delete/' . $p['id'] . '?type=on_sale'); ?>"  class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk on sale ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Belum ada produk On Sale.</p>
  <?php endif; ?>

</div>
</body>
</html>