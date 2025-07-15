<template>
  <div class="page-wrapper">
    <div class="container_edit">
      <h2>Edit Produk On Sale</h2>
      <router-link to="/products/manage">← Kembali ke Daftar Produk</router-link>

      <div v-if="success" class="message success">
        <p>Produk berhasil diperbarui.</p>
      </div>
      <div v-if="errors.length" class="errors">
        <p v-for="(e, i) in errors" :key="i">{{ e }}</p>
      </div>

      <form @submit.prevent="handleSubmit">
        <label>Judul Produk:
          <input v-model="form.title" type="text" required>
        </label>
        <label>Spesifikasi Singkat:
          <input v-model="form.specs" type="text" required>
        </label>
        <label>Harga:
          <input v-model="form.price" type="number" required>
        </label>
        <label>Harga Lama:
          <input v-model="form.old_price" type="number">
        </label>
        <label>Status:
          <select v-model="form.status">
            <option>In Stock</option>
            <option>Out of Stock</option>
          </select>
        </label>
        <label>Kategori:
          <input v-model="form.category" type="text">
        </label>
        <label>Link Pembelian:
          <input v-model="form.buy_link" type="text">
        </label>
        <label>Deskripsi Panjang:
          <textarea v-model="form.description" rows="5"></textarea>
        </label>

        <button type="submit">Simpan Perubahan</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: '',
        specs: '',
        price: '',
        old_price: '',
        status: 'In Stock',
        category: '',
        buy_link: '',
        description: ''
      },
      errors: [],
      success: false
    }
  },
  created() {
    this.fetchProduct()
  },
  methods: {
    async fetchProduct() {
      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/products/get_on_sale_by_id_api/${this.$route.params.id}`, {
          credentials: 'include'
        })
        const data = await res.json()
        if (data.status === false) {
          this.errors.push(data.message)
        } else {
          this.form = data
        }
      } catch (e) {
        this.errors.push('Gagal mengambil data produk.')
      }
    },
    async handleSubmit() {
      this.errors = []
      this.success = false

      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/products/update_on_sale_api/${this.$route.params.id}`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify(this.form)
        })
        const result = await res.json()
        if (result.status) {
          this.success = true
          this.$router.push('/products/manage')
        } else {
          this.errors.push(result.message || 'Gagal memperbarui produk.')
        }
      } catch (e) {
        this.errors.push('Gagal terhubung ke server.')
      }
    }
  }
}
</script>


<style scoped>
.page-wrapper {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #4E71FF;
  margin: 0;
  padding: 0;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.container_edit {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 40px;
  max-width: 750px;
  width: 100%;
  box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
  animation: fadeIn 0.7s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.container_edit h2 {
  font-size: 32px;
  color: #222;
  text-align: center;
  margin-bottom: 30px;
  position: relative;
}

.container_edit h2::after {
  content: '';
  width: 70px;
  height: 4px;
  background: linear-gradient(90deg, #667eea, #764ba2);
  display: block;
  margin: 10px auto 0;
  border-radius: 5px;
}

.container_edit a {
  display: inline-block;
  margin-bottom: 25px;
  color: #5a54ff;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

.container_edit a:hover {
  text-decoration: underline;
  color: #3e38d6;
}

form label {
  font-weight: 600;
  display: block;
  margin-bottom: 10px;
  color: #444;
}

input[type="text"],
input[type="number"],
textarea,
select {
  width: 100%;
  padding: 14px 16px;
  margin-bottom: 22px;
  border-radius: 14px;
  border: 1px solid #ccc;
  font-size: 15px;
  background: #f9f9f9;
  transition: all 0.3s ease;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}

input:focus,
textarea:focus,
select:focus {
  border-color: #6c63ff;
  background-color: #fff;
  outline: none;
  box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.2);
}

button {
  width: 100%;
  padding: 16px;
  background: linear-gradient(to right, #6c63ff, #8a82ff);
  color: #fff;
  font-size: 17px;
  font-weight: bold;
  border: none;
  border-radius: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 10px 20px rgba(108, 99, 255, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

button:hover {
  background: linear-gradient(to right, #5b52e5, #7c75f0);
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(108, 99, 255, 0.4);
}

button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.message.success {
  background-color: #d4edda;
  color: #155724;
  padding: 12px 18px;
  border-left: 6px solid #28a745;
  border-radius: 10px;
  margin-bottom: 20px;
}

.errors {
  background-color: #f8d7da;
  color: #721c24;
  padding: 12px 18px;
  border-left: 6px solid #dc3545;
  border-radius: 10px;
  margin-bottom: 20px;
}

textarea {
  resize: vertical;
}

@media (max-width: 768px) {
  .container_edit {
    padding: 30px 20px;
  }

  .container_edit h2 {
    font-size: 26px;
  }

  button {
    font-size: 16px;
  }
}
</style>
