<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
  
</head> 
<body class ="edit">
<div class="container_edit">
  <h2>Edit Produk</h2>
  <a href="<?php echo site_url('index.php/products/manage'); ?>">&larr; Kembali ke daftar produk</a>

  <?php if ($success): ?>
    <div class="message success"><p>Produk berhasil diperbarui.</p></div>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $err): ?>
        <p><?php echo htmlspecialchars($err); ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post">
    <label>Judul Produk:
      <input type="text" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>
    </label>
    <label>Spesifikasi Singkat:
      <input type="text" name="specs" value="<?php echo htmlspecialchars($product['specs']); ?>" required>
    </label>
    <label>Harga:
      <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
    </label>
    <label>Harga Lama:
      <input type="number" name="old_price" value="<?php echo htmlspecialchars($product['old_price']); ?>">
    </label>
    <label>Status:
      <select name="status">
        <option value="In Stock" <?php if ($product['status'] === 'In Stock') echo 'selected'; ?>>In Stock</option>
        <option value="Out of Stock" <?php if ($product['status'] === 'Out of Stock') echo 'selected'; ?>>Out of Stock</option>
      </select>
    </label>
    <label>Kategori:
      <input type="text" name="category" value="<?php echo htmlspecialchars($product['category']); ?>">
    </label>
    <label>Link Pembelian:
      <input type="text" name="buy_link" value="<?php echo htmlspecialchars($product['buy_link']); ?>">
    </label>
    <label>Deskripsi Panjang:
      <textarea name="description" rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
    </label>
    <button type="submit">Simpan Perubahan</button>
  </form>
</div>
</body>
</html>
