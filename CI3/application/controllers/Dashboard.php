<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

   public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper('auth_check');

		// Jalankan hanya jika bukan API
		if (strpos($_SERVER['REQUEST_URI'], 'api') === false) {
			require_login();
		}
	}



    public function index() {
        // Redirect ke dashboard_user
        redirect('users/dashboard_user');
    }

    public function dashboard_user() {
        // Ambil semua user dari database
        $data['users'] = $this->User_model->get_all_users();

        // Cek apakah ada flash message
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type');

        // Load view
        $this->load->view('users/dashboard_user', $data);
    }

	public function create() {
    $errors = [];
    $success = false;

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$username = $this->input->post('username');
			$nama_lengkap = $this->input->post('nama_lengkap');
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$password = $this->input->post('password');

			if (empty($username)) $errors[] = 'Username wajib diisi.';
			if (empty($nama_lengkap)) $errors[] = 'Nama lengkap wajib diisi.';
			if (empty($email)) $errors[] = 'Email wajib diisi.';
			if (empty($password)) $errors[] = 'Password wajib diisi.';

			if (empty($errors)) {
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$data = [
					'username' => $username,
					'nama_lengkap' => $nama_lengkap,
					'email' => $email,
					'role' => $role,
					'password' => $hashed_password,
					'created_at' => date('Y-m-d H:i:s')
				];

				if ($this->User_model->insert_user($data)) {
					$success = true;
				} else {
					$errors[] = 'Gagal menambahkan admin.';
				}
			}
		}

		$this->load->view('users/create', [
			'errors' => $errors,
			'success' => $success
		]);
	}

	public function delete($id)
	{
		// Cegah user menghapus dirinya sendiri
		if ($this->session->userdata('user_id') == $id) {
			$this->session->set_flashdata('message', 'Anda tidak dapat menghapus akun Anda sendiri.');
			$this->session->set_flashdata('message_type', 'error');
			redirect('index.php/users/dashboard_user');
			return;
		}

		// Cek apakah user dengan ID tersebut ada
		$user = $this->User_model->get_user_by_id($id);

		if (!$user) {
			$this->session->set_flashdata('message', 'User tidak ditemukan.');
			$this->session->set_flashdata('message_type', 'error');
		} else {
			if ($this->User_model->delete_user($id)) {
				$this->session->set_flashdata('message', 'User berhasil dihapus.');
				$this->session->set_flashdata('message_type', 'success');
			} else {
				$this->session->set_flashdata('message', 'Terjadi kesalahan saat menghapus user.');
				$this->session->set_flashdata('message_type', 'error');
			}
		}

		redirect('index.php/users/dashboard_user');
	}

	public function edit($id)
	{
		// Ambil data user
		$user = $this->User_model->get_user_by_id($id);

		if ( ! $user) {
			$this->session->set_flashdata('message', 'User tidak ditemukan.');
			$this->session->set_flashdata('message_type', 'error');
			redirect('index.php/users/dashboard_user');
			return;
		}

		$errors = [];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username      = trim($this->input->post('username'));
			$nama_lengkap  = trim($this->input->post('nama_lengkap'));
			$email         = trim($this->input->post('email'));
			$role          = $this->input->post('role');
			$password      = $this->input->post('password');

			// Validasi
			if (empty($username) || empty($nama_lengkap) || empty($email) || empty($role)) {
				$errors[] = "Semua field kecuali password wajib diisi.";
			}

			if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = "Format email tidak valid.";
			}

			if (empty($errors)) {
				// Cek username apakah dipakai oleh user lain
				if ($this->User_model->username_exists_other($username, $id)) {
					$errors[] = "Username sudah digunakan oleh user lain.";
				} else {
					// Update
					$update_data = [
						'username'      => $username,
						'nama_lengkap'  => $nama_lengkap,
						'email'         => $email,
						'role'          => $role
					];

					if ( ! empty($password)) {
						$update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
					}

					if ($this->User_model->update_user($id, $update_data)) {
						$this->session->set_flashdata('message', 'User berhasil diperbarui.');
						$this->session->set_flashdata('message_type', 'success');
						redirect('index.php/users/dashboard_user');
						return;
					} else {
						$errors[] = "Gagal memperbarui user.";
					}
				}
			}
		}

		// Load form edit
		$this->load->view('users/edit_user', [
			'user'    => $user,
			'errors'  => $errors
		]);
	}

	public function list_api() {
		header("Access-Control-Allow-Origin: http://localhost:5173");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
		header('Content-Type: application/json');

		$this->load->model('User_model');
		$users = $this->User_model->get_all_users();

		echo json_encode($users);
	}

	private function is_api_request() {
		return strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false
			|| strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false;
	}


	public function create_api()
	{
			if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
			header("Access-Control-Allow-Origin: http://localhost:5173");
			header("Access-Control-Allow-Methods: POST, OPTIONS");
			header("Access-Control-Allow-Headers: Content-Type");
			header("Access-Control-Allow-Credentials: true");
			exit(0);
		}

		header("Access-Control-Allow-Origin: http://localhost:5173");
		header("Access-Control-Allow-Credentials: true");
		header("Content-Type: application/json");


		$data = json_decode(file_get_contents('php://input'), true);
		$errors = [];

		if (empty($data['username']))      $errors[] = 'Username wajib diisi.';
		if (empty($data['nama_lengkap']))  $errors[] = 'Nama lengkap wajib diisi.';
		if (empty($data['email']))         $errors[] = 'Email wajib diisi.';
		if (empty($data['password']))      $errors[] = 'Password wajib diisi.';
		if (empty($data['role']))          $errors[] = 'Role wajib dipilih.';

		if (!empty($errors)) {
			echo json_encode(['status' => false, 'message' => implode(' ', $errors)]);
			return;
		}

		// Cek username unik
		$this->load->model('User_model');
		if ($this->User_model->username_exists($data['username'])) {
			echo json_encode(['status' => false, 'message' => 'Username sudah digunakan.']);
			return;
		}

		$data_insert = [
			'username'     => $data['username'],
			'nama_lengkap' => $data['nama_lengkap'],
			'email'        => $data['email'],
			'password'     => password_hash($data['password'], PASSWORD_DEFAULT),
			'role'         => $data['role']
		];

		$this->db->insert('users', $data_insert);

		echo json_encode(['status' => true, 'message' => 'User berhasil ditambahkan.']);
	}

	public function get_user($id)
	{
		header("Access-Control-Allow-Origin: http://localhost:5173");
		header("Access-Control-Allow-Credentials: true");
		header("Content-Type: application/json");

		$user = $this->User_model->get_user_by_id($id);
		if ($user) {
			echo json_encode($user);
		} else {
			echo json_encode(['error' => 'User tidak ditemukan']);
		}
	}

	public function update_api($id)
	{
		header("Access-Control-Allow-Origin: http://localhost:5173");
		header("Access-Control-Allow-Credentials: true");
		header("Content-Type: application/json");

		$data = json_decode(file_get_contents("php://input"), true);
		$errors = [];

		if (empty($data['username']) || empty($data['nama_lengkap']) || empty($data['email']) || empty($data['role'])) {
			echo json_encode(['status' => false, 'message' => 'Semua field wajib diisi.']);
			return;
		}

		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			echo json_encode(['status' => false, 'message' => 'Email tidak valid.']);
			return;
		}

		// Cek duplikat username
		if ($this->User_model->username_exists_other($data['username'], $id)) {
			echo json_encode(['status' => false, 'message' => 'Username sudah digunakan.']);
			return;
		}

		$update_data = [
			'username'     => $data['username'],
			'nama_lengkap' => $data['nama_lengkap'],
			'email'        => $data['email'],
			'role'         => $data['role']
		];

		if (!empty($data['password'])) {
			$update_data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		}

		$this->User_model->update_user($id, $update_data);
		echo json_encode(['status' => true, 'message' => 'User berhasil diperbarui.']);
	}

	public function get_user_by_id_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    $user = $this->User_model->get_user_by_id($id);
    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['status' => false, 'message' => 'User tidak ditemukan']);
    }
}


public function update_user_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(['status' => false, 'message' => 'Data tidak valid.']);
        return;
    }

    $update_data = [
        'username'     => $data['username'],
        'nama_lengkap' => $data['nama_lengkap'],
        'email'        => $data['email'],
        'role'         => $data['role']
    ];

    if (!empty($data['password'])) {
        $update_data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    $this->load->model('User_model');
    $updated = $this->User_model->update_user($id, $update_data);

    echo json_encode([
        'status' => $updated,
        'message' => $updated ? 'User berhasil diperbarui.' : 'Gagal memperbarui user.'
    ]);
}
public function delete_user_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    // Cek apakah user sedang login
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => false, 'message' => 'Anda belum login.']);
        return;
    }

    // Jangan biarkan user menghapus dirinya sendiri
    if ($_SESSION['user_id'] == $id) {
        echo json_encode(['status' => false, 'message' => 'Anda tidak bisa menghapus akun Anda sendiri.']);
        return;
    }

    $this->load->model('User_model');
    $user = $this->User_model->get_user_by_id($id);
    if (!$user) {
        echo json_encode(['status' => false, 'message' => 'User tidak ditemukan.']);
        return;
    }

    if ($this->User_model->delete_user($id)) {
        echo json_encode(['status' => true, 'message' => 'User berhasil dihapus.']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal menghapus user.']);
    }
}






}
