<template>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-12 col-md-3 col-lg-2 bg-primary text-white min-vh-100 p-3 d-flex flex-column">
        <div class="mb-4 d-flex align-items-center gap-3">
          <i class="bi bi-person-circle" style="font-size: 48px; color: #fff;"></i>
          <div>
            <h2 class="h5 fw-bold mb-1">Manajemen Admin</h2>
            <small class="text-light d-block">
              Halo, {{ user.nama_lengkap }}<br />
              ({{ user.role }})
            </small>
          </div>
        </div>

        <ul class="list-group list-group-flush mt-3 flex-grow-1">
          <li class="list-group-item bg-primary border-0 p-0 mb-2">
            <router-link to="/products/manage" class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded">
              <i class="bi bi-box"></i> Manajemen Produk
            </router-link>
          </li>
          <li class="list-group-item bg-primary border-0 p-0 mb-2">
            <router-link to="/" class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded">
              <i class="bi bi-house"></i> Halaman Utama
            </router-link>
          </li>
          <li class="list-group-item bg-primary border-0 p-0 mb-2">
            <a href="#" @click.prevent="logout" class="nav-link text-white d-flex align-items-center gap-2 px-3 py-2 rounded">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </nav>

      <!-- Konten utama -->
      <main class="col-12 col-md-9 col-lg-10 p-4">
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
              <tr v-for="u in users" :key="u.id">
                <td>{{ u.id }}</td>
                <td>{{ u.username }}</td>
                <td>{{ u.nama_lengkap }}</td>
                <td>{{ u.email }}</td>
                <td>{{ u.role }}</td>
                <td>{{ formatDate(u.created_at) }}</td>
                <td>
                  <router-link :to="'/users/edit/' + u.id" class="btn btn-sm btn-primary">Edit</router-link>
                  <button
                    v-if="user.id != u.id"
                    class="btn btn-sm btn-danger ms-2"
                    @click="deleteUser(u.id)"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-3 d-flex justify-content-end">
          <router-link to="/users/create" class="btn btn-success">Tambah Admin Baru</router-link>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      user: {
        id: '',
        nama_lengkap: '',
        role: ''
      }
    };
  },
  created() {
    const userData = sessionStorage.getItem('user');
    if (!userData) {
      this.$router.push('/login');
      return;
    }
    this.user = JSON.parse(userData);
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      fetch('http://localhost/technologia/CI3/index.php/users/list_api', {
        credentials: 'include'
      })
        .then(res => res.json())
        .then(data => {
          this.users = data;
        })
        .catch(() => {
          alert('Gagal mengambil data user.');
        });
    },
    deleteUser(id) {
      if (confirm('Yakin ingin menghapus user ini?')) {
        fetch(`http://localhost/technologia/CI3/index.php/users/delete_user_api/${id}`, {
          method: 'DELETE',
          credentials: 'include'
        })
          .then(res => res.json())
          .then(result => {
            if (result.status) {
              alert('User berhasil dihapus.');
              this.fetchUsers(); // refresh data
            } else {
              alert(result.message || 'Gagal menghapus user.');
            }
          })
          .catch(err => {
            console.error('Error:', err);
            alert('Terjadi kesalahan saat menghapus user.');
          });
      }
    },
    logout() {
      fetch('http://localhost/technologia/CI3/index.php/auth/logout_api', {
        credentials: 'include'
      })
        .then(res => res.json())
        .then(result => {
          if (result.status) {
            sessionStorage.removeItem('user');
            this.$router.push('/login');
          } else {
            alert('Logout gagal.');
          }
        });
    },
    formatDate(dateStr) {
      const d = new Date(dateStr);
      return d.toLocaleString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      });
    }
  }
};
</script>

<style scoped>
.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.15);
}
</style>
