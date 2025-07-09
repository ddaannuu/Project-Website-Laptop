<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    }

    // ✅ FINAL version of `manage()` (menggabungkan semua data)
   public function manage() {
        $error = '';
        try {
            $products     = $this->Product_model->get_all_products();
            $best_sellers = $this->Product_model->get_all_best_sellers();
            $on_sales     = $this->Product_model->get_all_on_sale();
        } catch (Exception $e) {
            $products     = [];
            $best_sellers = [];
            $on_sales     = [];
            $error = "Gagal mengambil data produk: " . $e->getMessage();
        }

        $this->load->view('products/manage_products', [
            'products'     => $products,
            'best_sellers' => $best_sellers,
            'on_sales'     => $on_sales,
            'error'        => $error
        ]);
    }

    // GET semua produk sebagai JSON
    public function index() {
        header('Content-Type: application/json');
        $products = $this->Product_model->get_all_products();
        echo json_encode($products);
    }

    public function list() {
        $products = $this->Product_model->get_all_products();
        $this->load->view('products_list', ['products' => $products]);
    }
    public function fetch_all() {

    header('Content-Type: application/json');
    $response = [
        'products' => $this->Product_model->get_all_products(),
        'best_sellers' => $this->Product_model->get_all_best_sellers(),
        'on_sales' => $this->Product_model->get_all_on_sale()
    ];
    echo json_encode($response);
}
public function create_form() {
    header('Content-Type: application/json');
    $errors = [];
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $slug        = $this->input->post('slug');
        $title       = $this->input->post('title');
        $specs       = $this->input->post('specs');
        $price       = $this->input->post('price');
        $old_price   = $this->input->post('old_price');
        $status      = $this->input->post('status');
        $category    = $this->input->post('category');
        $buy_link    = $this->input->post('buy_link');
        $description = $this->input->post('description');
        $upload_dir  = realpath(dirname(APPPATH) . '/../vue-project/public/Images/') . '/';

        $image_1 = $this->_upload_file('image_1_file', $upload_dir, $errors, 'Gambar 1');
        $image_2 = $this->_upload_file('image_2_file', $upload_dir, $errors, 'Gambar 2');
        $image_3 = $this->_upload_file('image_3_file', $upload_dir, $errors, 'Gambar 3');
        $qr_code = $this->_upload_file('qr_code_file', $upload_dir, $errors, 'QR Code');

        if (empty($image_1)) {
            $errors[] = "Gambar 1 wajib diupload.";
        }

        if (empty($errors)) {
            $data = [
                'slug'        => $slug,
                'title'       => $title,
                'specs'       => $specs,
                'price'       => $price,
                'old_price'   => $old_price,
                'status'      => $status,
                'image_1'     => $image_1,
                'image_2'     => $image_2,
                'image_3'     => $image_3,
                'category'    => $category,
                'buy_link'    => $buy_link,
                'description' => $description,
                'qr_code'     => $qr_code
            ];

            $this->db->insert('products', $data);
            $id = $this->db->insert_id();
            $success = true;

            $is_best_seller = $this->input->post('is_best_seller');
            $is_on_sale     = $this->input->post('is_on_sale');

            if ($is_best_seller) {
                $this->Product_model->insert_best_seller($id);
            }

            if ($is_on_sale) {
                $this->Product_model->insert_on_sale($id);
            }

            if ($is_best_seller || $is_on_sale) {
                $this->db->delete('products', ['id' => $id]);
            }
        }
    }
header('Content-Type: application/json');
echo json_encode([
    'success' => $success,
    'errors' => $errors
]);

}




     public function delete($id) {
        $type = $this->input->get('type');

        if (!is_numeric($id)) {
            echo json_encode(['status' => false, 'message' => 'ID tidak valid.']);
            return;
        }

        switch ($type) {
            case 'products':
                $product = $this->Product_model->get_product_by_id($id);
                if (!$product) {
                    echo json_encode(['status' => false, 'message' => 'Produk tidak ditemukan.']);
                    return;
                }
                $basePath = realpath(dirname(APPPATH) . '/../vue-project/public');
                foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
                    if (!empty($product[$imgField])) {
                        $filePath = $basePath . $product[$imgField];
                        if (file_exists($filePath)) unlink($filePath);
                    }
                }
                $this->Product_model->delete_product($id);
                break;
            case 'best_seller':
                $this->Product_model->delete_best_seller($id);
                break;
            case 'on_sale':
                $this->Product_model->delete_on_sale($id);
                break;
            default:
                echo json_encode(['status' => false, 'message' => 'Tipe produk tidak valid.']);
                return;
        }

        echo json_encode(['status' => true]);
    }


    public function detail($slug) {
        header('Content-Type: application/json');
        $product = $this->Product_model->get_product_by_slug($slug);
        echo json_encode($product ? $product : ['error' => 'Produk tidak ditemukan']);
    }

   public function detail_view($slug) {
    // Set header response menjadi JSON
    header('Content-Type: application/json');

    // Ambil parameter type dari query string (?type=products, best_seller, atau on_sale)
    $type = $this->input->get('type');

    // Validasi parameter slug dan type
    if (empty($slug) || empty($type)) {
        echo json_encode([
            'status' => false,
            'message' => 'Parameter slug dan type wajib diisi.'
        ]);
        return;
    }

    // Tentukan nama tabel berdasarkan type
    $table = '';
    if ($type === 'products') {
        $table = 'products';
    } elseif ($type === 'best_seller') {
        $table = 'best_seller';
    } elseif ($type === 'on_sale') {
        $table = 'on_sale';
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Parameter type tidak valid.'
        ]);
        return;
    }

    // Query data berdasarkan slug
    $this->db->where('slug', $slug);
    $query = $this->db->get($table);
    $product = $query->row_array();

    // Kembalikan hasil sebagai JSON
    if ($product) {
        echo json_encode([
            'status' => true,
            'data' => $product
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Produk tidak ditemukan.'
        ]);
    }
}


    public function edit($id) {
        if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) show_error('Produk tidak ditemukan.', 404);

        $errors = [];
        $success = false;

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $data_update = [
                'title'       => $this->input->post('title'),
                'specs'       => $this->input->post('specs'),
                'price'       => $this->input->post('price'),
                'old_price'   => $this->input->post('old_price'),
                'status'      => $this->input->post('status'),
                'category'    => $this->input->post('category'),
                'buy_link'    => $this->input->post('buy_link'),
                'description' => $this->input->post('description')
            ];

            try {
                $this->Product_model->update_product($id, $data_update);
                $success = true;
                $product = $this->Product_model->get_product_by_id($id);
            } catch (Exception $e) {
                $errors[] = "Gagal mengupdate produk: " . $e->getMessage();
            }
        }

        $this->load->view('products/edit_product', [
            'product' => $product,
            'errors'  => $errors,
            'success' => $success
        ]);
    }

    // Helper upload file
    private function _upload_file($field_name, $upload_path, &$errors, $label) {
        if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
            $filename = time() . '_' . basename($_FILES[$field_name]['name']);
            $target_path = $upload_path . $filename;
            if (move_uploaded_file($_FILES[$field_name]['tmp_name'], $target_path)) {
                return '/Images/' . $filename;
            } else {
                $errors[] = "Gagal mengupload $label.";
            }
        }
        return '';
    }

	// EDIT BEST SELLER
public function edit_best_seller($id) {
    $this->load->model('Product_model');
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_best_seller_by_id($id);
    if (!$product) show_error('Produk Best Seller tidak ditemukan.', 404);

    $errors = [];
    $success = false;

    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $data_update = [
            'title'       => $this->input->post('title'),
            'specs'       => $this->input->post('specs'),
            'price'       => $this->input->post('price'),
            'old_price'   => $this->input->post('old_price'),
            'status'      => $this->input->post('status'),
            'category'    => $this->input->post('category'),
            'buy_link'    => $this->input->post('buy_link'),
            'description' => $this->input->post('description')
        ];

        try {
            $this->Product_model->update_best_seller($id, $data_update);
            $success = true;
            $product = $this->Product_model->get_best_seller_by_id($id);
        } catch (Exception $e) {
            $errors[] = "Gagal mengupdate produk best seller: " . $e->getMessage();
        }
    }

    $this->load->view('products/edit_best_seller', [
        'product' => $product,
        'errors'  => $errors,
        'success' => $success
    ]);
}

// DELETE BEST SELLER
public function delete_best_seller($id) {
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_best_seller_by_id($id);
    if (!$product) show_error('Produk Best Seller tidak ditemukan.', 404);

    $this->Product_model->delete_best_seller($id);

    redirect('index.php/products/manage?deleted=1');
}

// EDIT ON SALE
public function edit_on_sale($id) {
    $this->load->model('Product_model');
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_on_sale_by_id($id);
    if (!$product) show_error('Produk On Sale tidak ditemukan.', 404);

    $errors = [];
    $success = false;

    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $data_update = [
            'title'       => $this->input->post('title'),
            'specs'       => $this->input->post('specs'),
            'price'       => $this->input->post('price'),
            'old_price'   => $this->input->post('old_price'),
            'status'      => $this->input->post('status'),
            'category'    => $this->input->post('category'),
            'buy_link'    => $this->input->post('buy_link'),
            'description' => $this->input->post('description')
        ];

        try {
            $this->Product_model->update_on_sale($id, $data_update);
            $success = true;
            $product = $this->Product_model->get_on_sale_by_id($id);
        } catch (Exception $e) {
            $errors[] = "Gagal mengupdate produk on sale: " . $e->getMessage();
        }
    }

    $this->load->view('products/edit_on_sale', [
        'product' => $product,
        'errors'  => $errors,
        'success' => $success
    ]);
}
public function delete_on_sale($id) {
    if (!is_numeric($id)) show_error('ID produk tidak valid.', 400);

    $product = $this->Product_model->get_on_sale_by_id($id);
    if (!$product) show_error('Produk On Sale tidak ditemukan.', 404);

    $this->Product_model->delete_on_sale($id);

    redirect('index.php/products/manage?deleted=1');
}

public function get_by_id($id)
{
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    $this->load->model('Product_model');
    $product = $this->Product_model->get_product_by_id($id);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Produk tidak ditemukan.']);
    }
}

public function update($id)
{
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
        return;
    }

    $this->load->model('Product_model');

    $updateData = [
        'title'       => $data['title'],
        'specs'       => $data['specs'],
        'price'       => $data['price'],
        'old_price'   => $data['old_price'],
        'status'      => $data['status'],
        'category'    => $data['category'],
        'buy_link'    => $data['buy_link'],
        'description' => $data['description']
    ];

    $success = $this->Product_model->update_product($id, $updateData);

    if ($success) {
        echo json_encode(['status' => true, 'message' => 'Produk berhasil diperbarui.']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal memperbarui produk.']);
    }
}

public function get_product_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    $this->load->model('Product_model');
    $product = $this->Product_model->get_product_by_id($id);
    echo json_encode($product);
}

public function update_product_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(0);

    $input = json_decode(file_get_contents('php://input'), true);

    $data = [
        'title' => $input['title'],
        'specs' => $input['specs'],
        'price' => $input['price'],
        'old_price' => $input['old_price'],
        'status' => $input['status'],
        'category' => $input['category'],
        'buy_link' => $input['buy_link'],
        'description' => $input['description']
    ];

    $this->load->model('Product_model');
    $updated = $this->Product_model->update_product($id, $data);

    if ($updated) {
        echo json_encode(['status' => true]);
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal memperbarui produk.']);
    }
}

public function update_on_sale_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $this->load->model('Product_model');

    $update = [
        'title'       => $data['title'] ?? '',
        'specs'       => $data['specs'] ?? '',
        'price'       => $data['price'] ?? 0,
        'old_price'   => $data['old_price'] ?? 0,
        'status'      => $data['status'] ?? 'In Stock',
        'category'    => $data['category'] ?? '',
        'buy_link'    => $data['buy_link'] ?? '',
        'description' => $data['description'] ?? '',
    ];

    $updated = $this->Product_model->update_on_sale($id, $update);

    if ($updated) {
        echo json_encode(['status' => true, 'message' => 'Produk berhasil diperbarui']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Produk tidak ditemukan atau gagal diperbarui']);
    }
}

public function get_on_sale_by_id_api($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");

    $this->load->model('Product_model');
    $product = $this->Product_model->get_on_sale_by_id($id);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['status' => false, 'message' => 'Produk tidak ditemukan']);
    }

	
}

// Ambil detail produk best seller berdasarkan ID (GET)
public function get_best_seller_by_id($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json");

    $product = $this->Product_model->get_best_seller_by_id($id);
    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['status' => false, 'message' => 'Produk tidak ditemukan']);
    }
}

// Update produk best seller berdasarkan ID (POST)
public function update_best_seller($id) {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
        return;
    }

    $update_data = [
        'title'       => $data['title'] ?? '',
        'specs'       => $data['specs'] ?? '',
        'price'       => $data['price'] ?? 0,
        'old_price'   => $data['old_price'] ?? 0,
        'status'      => $data['status'] ?? '',
        'category'    => $data['category'] ?? '',
        'buy_link'    => $data['buy_link'] ?? '',
        'description' => $data['description'] ?? ''
    ];

    $this->load->model('Product_model');
    $success = $this->Product_model->update_best_seller($id, $update_data);

    if ($success) {
        echo json_encode(['status' => true, 'message' => 'Produk berhasil diperbarui']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal memperbarui produk']);
    }
}


public function get_by_slug($slug)
{
    header('Content-Type: application/json');

    $product = $this->Product_model->get_product_by_slug($slug);
    $table = 'products';

    if (!$product) {
        $product = $this->Product_model->get_best_seller_by_slug($slug);
        $table = 'best_seller';
    }

    if (!$product) {
        $product = $this->Product_model->get_on_sale_by_slug($slug);
        $table = 'on_sale';
    }

    if ($product) {
        $related = $this->Product_model->get_related_products($slug, $table);
        echo json_encode([
            'product' => $product,
            'related' => $related
        ]);
    } else {
        echo json_encode(['error' => 'Produk tidak ditemukan']);
    }
}

}


