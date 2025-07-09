<template>
  <div class="page-wrapper">
  <div class="container-edit">
    <h2>Edit User</h2>
    <router-link to="/dashboard" class="back-link">← Kembali ke Manajemen User</router-link>

    <div v-if="errors.length" class="errors">
      <p v-for="(err, i) in errors" :key="i">{{ err }}</p>
    </div>

    <div v-if="success" class="success">
      <p>Data user berhasil diperbarui.</p>
    </div>

    <form @submit.prevent="updateUser">
      <div>
        <label>Username:</label>
        <input type="text" v-model="form.username" required />
      </div>

      <div>
        <label>Nama Lengkap:</label>
        <input type="text" v-model="form.nama_lengkap" required />
      </div>

      <div>
        <label>Email:</label>
        <input type="email" v-model="form.email" required />
      </div>

      <div>
        <label>Password (kosongkan jika tidak diubah):</label>
        <input type="password" v-model="form.password" />
      </div>

      <div>
        <label>Role:</label>
        <select v-model="form.role" required>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit">Simpan Perubahan</button>
      </div>
    </form>
  </div>
  </div>
</template>

<script>
export default {
  name: 'EditUser',
  data() {
    return {
      form: {
        username: '',
        nama_lengkap: '',
        email: '',
        password: '',
        role: 'admin'
      },
      errors: [],
      success: false
    }
  },
  created() {
    const session = sessionStorage.getItem('user');
    if (!session) {
      this.$router.push('/login');
      return;
    }
    this.fetchUser();
  },
  mounted() {
    document.body.classList.add("edit");
  },
  beforeUnmount() {
    document.body.classList.remove("edit");
  },
  methods: {
    async fetchUser() {
      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/users/get_user_by_id_api/${this.$route.params.id}`, {
          credentials: 'include'
        });
        if (!res.ok) throw new Error('Gagal ambil user');
        const userData = await res.json();
        this.form = { ...userData, password: '' };
      } catch (err) {
        this.errors.push('Gagal mengambil data user.');
      }
    },

    async updateUser() {
      this.errors = [];
      this.success = false;

      try {
        const res = await fetch(`http://localhost/technologia/CI3/index.php/users/update_user_api/${this.$route.params.id}`, {
          method: 'POST',
          credentials: 'include',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        });

        const result = await res.json();
        if (result.status) {
          this.success = true;
          this.$router.push('/dashboard');
        } else {
          this.errors.push(result.message || 'Gagal memperbarui user.');
        }
      } catch (err) {
        this.errors.push('Gagal terhubung ke server.');
      }
    }
  }
}
</script>

<style scoped>
.page-wrapper {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4E71FF;
}

.container-edit {
  background: #ffffff;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 480px;
}

.container-edit h2 {
  text-align: center;
  color: #333;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
}

.back-link {
  display: block;
  text-align: center;
  margin-bottom: 1rem;
  color: #6c63ff;
  font-size: 0.9rem;
  text-decoration: none;
}

.success, .errors {
  padding: 0.75rem;
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

label {
  margin-bottom: 0.3rem;
  font-size: 0.9rem;
  color: #555;
}
input, select {
  padding: 0.7rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  width: 100%;
  font-size: 1rem;
  margin-bottom: 1rem;
  transition: border 0.2s ease;
}
input:focus, select:focus {
  border-color: #6c63ff;
  outline: none;
  box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
}


button {
  display: block;
  width: 100%;
  padding: 0.7rem;
  border: none;
  border-radius: 6px;
  background: #6c63ff;
  color: white;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.3s ease;
}
button:hover {
  background: #584fe0;
}


</style>
