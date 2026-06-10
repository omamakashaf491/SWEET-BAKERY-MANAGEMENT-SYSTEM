<?php
// api.php — Unified Backend Router & CRUD Processor
header('Content-Type: application/json; charset=UTF-8');

// Include DB config connection (suppresses exception tracking internally)
$mysqli = require __DIR__ . '/config.php';
$mysqli->set_charset('utf8mb4');

// Parse action from query parameters, POST body, or JSON payload
$action = isset($_REQUEST['action']) ? strtoupper(trim($_REQUEST['action'])) : '';

// For POST requests with JSON content-type, parse the input stream once
$jsonData = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $raw = file_get_contents('php://input');
    $jsonData = json_decode($raw, true) ?: [];
    if (isset($jsonData['action']) && !$action) {
        $action = strtoupper(trim($jsonData['action']));
    }
}

// Fallback to READ_PRODUCTS if action is empty
if (!$action) {
    $action = 'READ_PRODUCTS';
}

switch ($action) {
    case 'READ_PRODUCTS':
    case 'READ_MENU':
    case 'READ':
        $products = [];
        // Perform left join to fetch product list with category name
        $sql = "SELECT p.id, p.name, p.price, p.description AS `desc`, p.image_url AS img, p.category_id AS categoryId, COALESCE(c.name, '') AS category FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id ASC";
        $res = $mysqli->query($sql);
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $products[] = [
                    'id' => (int)$row['id'],
                    'name' => $row['name'],
                    'price' => (float)$row['price'],
                    'description' => $row['desc'],
                    'desc' => $row['desc'], // front-end compatibility
                    'image_url' => $row['img'],
                    'img' => $row['img'], // front-end compatibility
                    'category_id' => $row['categoryId'] !== null ? (int)$row['categoryId'] : null,
                    'categoryId' => $row['categoryId'] !== null ? (int)$row['categoryId'] : null, // front-end compatibility
                    'category' => $row['category'],
                    'flavor' => '', // placeholder
                    'size' => ''    // placeholder
                ];
            }
        }

        $categories = [];
        $resCats = $mysqli->query("SELECT id, name FROM categories ORDER BY name ASC");
        if ($resCats) {
            while ($row = $resCats->fetch_assoc()) {
                $categories[] = [
                    'id' => (int)$row['id'],
                    'name' => $row['name']
                ];
            }
        }

        // Return unified response
        echo json_encode([
            'success' => true,
            'products' => $products,
            'categories' => $categories
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;

    case 'CREATE_PRODUCT':
    case 'CREATE':
        $name = trim($_POST['name'] ?? $jsonData['name'] ?? '');
        $price = floatval($_POST['price'] ?? $jsonData['price'] ?? 0);
        $description = trim($_POST['description'] ?? $jsonData['description'] ?? '');
        $image_url = trim($_POST['image_url'] ?? $jsonData['image_url'] ?? '');
        $category_id = $_POST['category_id'] ?? $jsonData['category_id'] ?? null;
        $category_name = trim($_POST['category'] ?? $jsonData['category'] ?? '');

        if (!$name || $price <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid product data: name and positive price required']);
            exit();
        }

        // If category text name is sent but not category_id, resolve it
        if (empty($category_id) && !empty($category_name)) {
            $cstmt = $mysqli->prepare("SELECT id FROM categories WHERE name = ? LIMIT 1");
            if ($cstmt) {
                $cstmt->bind_param('s', $category_name);
                $cstmt->execute();
                $cres = $cstmt->get_result();
                if ($crow = $cres->fetch_assoc()) {
                    $category_id = $crow['id'];
                } else {
                    // Create the category if it doesn't exist
                    $cinst = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
                    if ($cinst) {
                        $cinst->bind_param('s', $category_name);
                        if ($cinst->execute()) {
                            $category_id = $cinst->insert_id;
                        }
                        $cinst->close();
                    }
                }
                $cstmt->close();
            }
        }

        // Standardise empty value to null
        $categoryIdVal = !empty($category_id) ? intval($category_id) : null;

        $stmt = $mysqli->prepare("INSERT INTO products (name, price, description, image_url, category_id) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Prepare failed', 'details' => $mysqli->error]);
            exit();
        }

        $stmt->bind_param('sdsss', $name, $price, $description, $image_url, $categoryIdVal);
        $ok = $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();

        echo json_encode(['success' => (bool)$ok, 'id' => $id]);
        break;

    case 'UPDATE_PRODUCT':
    case 'UPDATE':
        $id = intval($_POST['id'] ?? $jsonData['id'] ?? 0);
        $name = trim($_POST['name'] ?? $jsonData['name'] ?? '');
        $price = floatval($_POST['price'] ?? $jsonData['price'] ?? 0);
        $description = trim($_POST['description'] ?? $jsonData['description'] ?? '');
        $image_url = trim($_POST['image_url'] ?? $jsonData['image_url'] ?? '');
        $category_id = $_POST['category_id'] ?? $jsonData['category_id'] ?? null;
        $category_name = trim($_POST['category'] ?? $jsonData['category'] ?? '');

        if (!$id || !$name || $price <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid product data: ID, name, and positive price required']);
            exit();
        }

        // If category text name is sent but not category_id, resolve it
        if (empty($category_id) && !empty($category_name)) {
            $cstmt = $mysqli->prepare("SELECT id FROM categories WHERE name = ? LIMIT 1");
            if ($cstmt) {
                $cstmt->bind_param('s', $category_name);
                $cstmt->execute();
                $cres = $cstmt->get_result();
                if ($crow = $cres->fetch_assoc()) {
                    $category_id = $crow['id'];
                } else {
                    $cinst = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
                    if ($cinst) {
                        $cinst->bind_param('s', $category_name);
                        if ($cinst->execute()) {
                            $category_id = $cinst->insert_id;
                        }
                        $cinst->close();
                    }
                }
                $cstmt->close();
            }
        }

        $categoryIdVal = !empty($category_id) ? intval($category_id) : null;

        $stmt = $mysqli->prepare("UPDATE products SET name = ?, price = ?, description = ?, image_url = ?, category_id = ? WHERE id = ?");
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Prepare failed', 'details' => $mysqli->error]);
            exit();
        }

        $stmt->bind_param('sdsssi', $name, $price, $description, $image_url, $categoryIdVal, $id);
        $ok = $stmt->execute();
        $stmt->close();

        echo json_encode(['success' => (bool)$ok]);
        break;

    case 'DELETE_PRODUCT':
    case 'DELETE':
        $id = intval($_REQUEST['id'] ?? $jsonData['id'] ?? 0);

        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing product ID']);
            exit();
        }

        $stmt = $mysqli->prepare("DELETE FROM products WHERE id = ?");
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Prepare failed', 'details' => $mysqli->error]);
            exit();
        }

        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();

        echo json_encode(['success' => (bool)$ok]);
        break;

    case 'PLACE_ORDER':
    case 'CHECKOUT':
        // Accept both JSON payload and form POST fields
        $name = trim($jsonData['customer_name'] ?? $jsonData['name'] ?? $_POST['customer_name'] ?? $_POST['name'] ?? '');
        $email = trim($jsonData['customer_email'] ?? $jsonData['email'] ?? $_POST['customer_email'] ?? $_POST['email'] ?? '');
        $address = trim($jsonData['address'] ?? $_POST['address'] ?? 'Online Order');
        $items = $jsonData['items'] ?? $_POST['items'] ?? [];
        $total = floatval($jsonData['total'] ?? $_POST['total'] ?? 0);

        if (is_string($items)) {
            $items = json_decode($items, true) ?: [];
        }

        if (!$name || !$email || !is_array($items) || count($items) === 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing required order fields: name, email, and items are required']);
            exit();
        }

        // Calculate total if not provided or 0
        if ($total <= 0) {
            foreach ($items as $item) {
                $qty = intval($item['qty'] ?? $item['quantity'] ?? 1);
                $price = floatval($item['price'] ?? $item['unit_price'] ?? 0);
                $total += $qty * $price;
            }
        }

        $mysqli->begin_transaction();
        try {
            $stmt = $mysqli->prepare("INSERT INTO orders (customer_name, customer_email, address, total, created_at) VALUES (?, ?, ?, ?, NOW())");
            if (!$stmt) throw new Exception($mysqli->error);
            $stmt->bind_param('sssd', $name, $email, $address, $total);
            $stmt->execute();
            $orderId = $mysqli->insert_id;
            $stmt->close();

            $itemStmt = $mysqli->prepare("INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
            if (!$itemStmt) throw new Exception($mysqli->error);

            foreach ($items as $item) {
                $productId = intval($item['id'] ?? $item['product_id'] ?? 0);
                $qty = intval($item['qty'] ?? $item['quantity'] ?? 1);
                $price = floatval($item['price'] ?? $item['unit_price'] ?? 0);

                if ($productId > 0 && $qty > 0) {
                    $itemStmt->bind_param('iiid', $orderId, $productId, $qty, $price);
                    $itemStmt->execute();
                }
            }
            $itemStmt->close();

            $mysqli->commit();
            echo json_encode([
                'success' => true, 
                'orderId' => $orderId,
                'order_id' => $orderId
            ]);
        } catch (Exception $e) {
            $mysqli->rollback();
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Order transaction failed', 'details' => $e->getMessage()]);
        }
        break;

    case 'READ_DASHBOARD':
        $productCount = 0;
        $resProd = $mysqli->query("SELECT COUNT(*) as cnt FROM products");
        if ($resProd && $row = $resProd->fetch_assoc()) {
            $productCount = (int)$row['cnt'];
        }

        $orderCount = 0;
        $resOrd = $mysqli->query("SELECT COUNT(*) as cnt FROM orders");
        if ($resOrd && $row = $resOrd->fetch_assoc()) {
            $orderCount = (int)$row['cnt'];
        }

        $totalRevenue = 0.0;
        $resRev = $mysqli->query("SELECT SUM(total) as revenue FROM orders");
        if ($resRev && $row = $resRev->fetch_assoc()) {
            $totalRevenue = floatval($row['revenue'] ?? 0);
        }

        echo json_encode([
            'success' => true,
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'totalRevenue' => $totalRevenue
        ]);
        break;

    case 'READ_DELIVERIES':
    case 'READ_ORDERS':
        $orders = [];
        $stmt = $mysqli->prepare("SELECT id, customer_name, address, total, created_at FROM orders ORDER BY id DESC LIMIT 10");
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $orders[] = [
                    'id' => (int)$row['id'],
                    'customer_name' => $row['customer_name'],
                    'address' => $row['address'],
                    'total' => (float)$row['total'],
                    'created_at' => $row['created_at']
                ];
            }
            $stmt->close();
        }
        echo json_encode(['success' => true, 'orders' => $orders]);
        break;

    case 'SUBMIT_CONTACT':
        $name = trim($_POST['name'] ?? $jsonData['name'] ?? '');
        $email = trim($_POST['email'] ?? $jsonData['email'] ?? '');
        $subject = trim($_POST['subject'] ?? $jsonData['subject'] ?? '');
        $message = trim($_POST['message'] ?? $jsonData['message'] ?? '');

        if ($name === '' || $email === '' || $message === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing required fields: name, email, and message are required']);
            exit();
        }

        $stmt = $mysqli->prepare("INSERT INTO contact_messages (name, email, subject, message, submitted_at) VALUES (?, ?, ?, ?, NOW())");
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Prepare failed', 'details' => $mysqli->error]);
            exit();
        }

        $stmt->bind_param('ssss', $name, $email, $subject, $message);
        $ok = $stmt->execute();
        $stmt->close();

        echo json_encode(['success' => (bool)$ok]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid or unknown action requested']);
}

$mysqli->close();
?>
