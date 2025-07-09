<template>
  <div class="page-wrapper">
    <div class="containerCreateu">
      <h2>Tambah User Baru</h2>

      <div v-if="errors.length > 0" class="errors">
        <p v-for="(err, idx) in errors" :key="idx">{{ err }}</p>
      </div>

      <div v-if="success" class="success">
        <p>User berhasil ditambahkan.</p>
      </div>

      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label>Username:</label>
          <input type="text" v-model="form.username" required />
        </div>

        <div class="form-group">
          <label>Nama Lengkap:</label>
          <input type="text" v-model="form.nama_lengkap" required />
        </div>

        <div class="form-group">
          <label>Email:</label>
          <input type="email" v-model="form.email" required />
        </div>

        <div class="form-group">
          <label>Password:</label>
          <input type="password" v-model="form.password" required />
        </div>

        <div class="form-group">
          <label>Role:</label>
          <select v-model="form.role" required>
            <option value="admin">Admin</option>
          </select>
        </div>

        <div class="form-group">
          <button type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        username: "",
        nama_lengkap: "",
        email: "",
        password: "",
        role: "admin",
      },
      errors: [],
      success: false,
    };
  },
  mounted() {
    document.body.classList.add("login");
  },
  beforeUnmount() {
    document.body.classList.remove("login");
  },
  methods: {
    async handleSubmit() {
      this.errors = [];
      this.success = false;

      try {
        const res = await fetch("http://localhost/technologia/CI3/index.php/users/create_api", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "include",
          body: JSON.stringify(this.form),
        });

        const result = await res.json();
        if (result.status) {
          this.success = true;
          this.form = { username: "", nama_lengkap: "", email: "", password: "", role: "admin" };
          setTimeout(() => {
            this.$router.push("/dashboard");
          }, 1000);
        } else {
          this.errors.push(result.message || "Gagal menambahkan user.");
        }
      } catch (err) {
        this.errors.push("Gagal terhubung ke server.");
      }
    },
  },
};
</script>

<style scoped>
.page-wrapper {
  min-height: 100vh;
  background: linear-gradient(to bottom right, #4e71ff, #5f5dff);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.containerCreateu {
  background: #eef2ff;
  padding: 2.5rem;
  border-radius: 20px;
  box-shadow: 0 25px 40px rgba(0, 0, 0, 0.2);
  max-width: 400px;
  width: 90%;
  animation: fadeIn 0.7s ease;
}

.containerCreateu h2 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 2rem;
  font-size: 1.8rem;
  font-weight: 600;
}

.form-group {
  margin-bottom: 0.5rem;
}

label {
  display: block;
  font-size: 0.95rem;
  margin-bottom: 0.5rem;
  color: #34495e;
}

input,
select {
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 10px;
  width: 100%;
  font-size: 1rem;
  background: #ffffff;
  box-shadow: inset 1px 1px 2px rgba(0, 0, 0, 0.05);
  transition: border 0.2s ease, box-shadow 0.3s ease;
}

input:focus,
select:focus {
  border-color: #6c63ff;
  outline: none;
  box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
}

button {
  width: 100%;
  padding: 0.9rem;
  border: none;
  border-radius: 10px;
  background: #6c63ff;
  color: white;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
}

button:hover {
  background: #584fe0;
}

.success,
.errors {
  padding: 0.75rem 1rem;
  border-radius: 6px;
  margin-bottom: 1rem;
  font-size: 0.9rem;
}

.success {
  background: #e0f7e0;
  border: 1px solid #7fd47f;
  color: #2a7d2a;
}

.errors {
  background: #fde8e8;
  border: 1px solid #f1b8b8;
  color: #b22d2d;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
