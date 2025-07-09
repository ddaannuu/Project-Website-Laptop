<template>
  <div class="page-wrapper">
    <div class="container_addP">
      <h2>Tambah Produk Laptop</h2>
      <router-link to="/products/manage">&larr; Kembali ke daftar produk</router-link>

      <div v-if="success" class="message success">
        <p>Produk berhasil ditambahkan.</p>
      </div>

      <div v-if="errors.length" class="errors">
        <p v-for="(err, idx) in errors" :key="idx">{{ err }}</p>
      </div>

      <form @submit.prevent="submitForm" class="form-container" enctype="multipart/form-data">
        <div class="form-group">
          <label>
            <input type="checkbox" v-model="form.is_best_seller" />
            Tambahkan ke Best Seller
          </label>
        </div>

        <div class="form-group">
          <label>
            <input type="checkbox" v-model="form.is_on_sale" />
            Tambahkan ke On Sale
          </label>
        </div>

        <div class="form-group" v-for="field in textFields" :key="field.name">
          <label>{{ field.label }}</label>
          <input :type="field.type" v-model="form[field.name]" :required="field.required" />
        </div>

        <div class="form-group">
          <label>Status:</label>
          <select v-model="form.status">
            <option value="In Stock">In Stock</option>
            <option value="Out of Stock">Out of Stock</option>
          </select>
        </div>

        <div class="form-group full-width">
          <label>Deskripsi Panjang/Detail (pisahkan pakai '|'):</label>
          <textarea v-model="form.description" rows="5"></textarea>
        </div>

        <div class="form-group" v-for="(label, key) in fileInputs" :key="key">
          <label>{{ label }}</label>
          <input type="file" @change="handleFileChange($event, key)" :required="key === 'image_1_file'" />
        </div>

        <button type="submit">Simpan Produk</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        is_best_seller: false,
        is_on_sale: false,
        slug: "",
        title: "",
        specs: "",
        price: "",
        old_price: "",
        status: "In Stock",
        category: "",
        buy_link: "",
        description: "",
      },
      files: {
        image_1_file: null,
        image_2_file: null,
        image_3_file: null,
        qr_code_file: null,
      },
      errors: [],
      success: false,
      textFields: [
        { name: "slug", label: "Slug/ID Produk:", type: "text", required: true },
        { name: "title", label: "Judul Produk:", type: "text", required: true },
        { name: "specs", label: "Spesifikasi Singkat:", type: "text", required: true },
        { name: "price", label: "Harga:", type: "number", required: true },
        { name: "old_price", label: "Harga Lama:", type: "number", required: false },
        { name: "category", label: "Kategori (dipisah koma):", type: "text", required: false },
        { name: "buy_link", label: "Link Pembelian:", type: "text", required: false },
      ],
      fileInputs: {
        image_1_file: "Gambar 1 (wajib):",
        image_2_file: "Gambar 2:",
        image_3_file: "Gambar 3:",
        qr_code_file: "QR Code:",
      },
    };
  },
  methods: {
    handleFileChange(event, name) {
      this.files[name] = event.target.files[0];
    },
    async submitForm() {
      this.errors = [];
      this.success = false;

      const formData = new FormData();

      // Tambahkan data teks
      for (const key in this.form) {
        let value = this.form[key];
        if (typeof value === "boolean") {
          value = value ? "1" : "";
        }
        formData.append(key, value);
      }

      // Tambahkan file
      for (const key in this.files) {
        if (this.files[key]) {
          formData.append(key, this.files[key]);
        }
      }

      try {
        const res = await fetch("http://localhost/technologia/CI3/index.php/products/create_form", {
          method: "POST",
          body: formData,
        });

        const data = await res.json();

        if (data.success) {
          this.success = true;
          this.resetForm();
        } else {
          this.errors = data.errors || ["Gagal menambahkan produk."];
        }
      } catch (err) {
        this.errors = ["Terjadi kesalahan saat mengirim data."];
      }
    },
    resetForm() {
      this.form = {
        is_best_seller: false,
        is_on_sale: false,
        slug: "",
        title: "",
        specs: "",
        price: "",
        old_price: "",
        status: "In Stock",
        category: "",
        buy_link: "",
        description: "",
      };
      this.files = {
        image_1_file: null,
        image_2_file: null,
        image_3_file: null,
        qr_code_file: null,
      };
    },
  },
};
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
.container_addP {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 40px;
  width: 100%;
  max-width: 800px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  animation: fadeIn 0.7s ease;
}


@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Heading */
.addP h2 {
  font-size: 32px;
  color: #222;
  text-align: center;
  margin-bottom: 30px;
  position: relative;
}

.addP h2::after {
  content: '';
  width: 80px;
  height: 4px;
  background: linear-gradient(to right, #667eea, #764ba2);
  display: block;
  margin: 12px auto 0;
  border-radius: 6px;
}

/* Kembali */
.addP a {
  display: inline-block;
  margin-bottom: 20px;
  color: #5a54ff;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.addP a:hover {
  color: #3e38d6;
  text-decoration: underline;
}

/* Form Styling */
.form-container {
  margin-top: 10px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  font-weight: 600;
  color: #444;
  display: block;
  margin-bottom: 8px;
}

input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select {
  width: 100%;
  padding: 14px 16px;
  border-radius: 12px;
  border: 1px solid #ccc;
  background: #f9f9f9;
  font-size: 15px;
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

textarea {
  resize: vertical;
}

/* Full Width Group */
.form-group.full-width {
  width: 100%;
}

/* Checkbox */
input[type="checkbox"] {
  margin-right: 8px;
}

/* Button */
button[type="submit"] {
  width: 100%;
  padding: 16px;
  background: linear-gradient(to right, #6c63ff, #8a82ff);
  color: white;
  font-size: 17px;
  font-weight: bold;
  border: none;
  border-radius: 14px;
  cursor: pointer;
  box-shadow: 0 12px 24px rgba(108, 99, 255, 0.3);
  transition: all 0.3s ease;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

button[type="submit"]:hover {
  background: linear-gradient(to right, #5b52e5, #7c75f0);
  transform: translateY(-2px);
}

/* Message Box */
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

/* Responsive */
@media (max-width: 768px) {
  .addP {
    padding: 25px 20px;
  }

  .addP h2 {
    font-size: 26px;
  }

  button[type="submit"] {
    font-size: 15px;
  }
}

</style>
