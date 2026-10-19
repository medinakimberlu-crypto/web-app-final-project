<?php
include_once 'header.php';
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: products.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $category_id = intval($_POST['category_id']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    $stmt = $pdo->prepare("UPDATE products SET name = ?, category_id = ?, quantity = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $category_id, $quantity, $price, $id]);
    header("Location: products.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<h2 class="fw-bold mb-4">Edit Product</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="edit.php?id=<?php echo $id; ?>" method="post">
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $product['category_id']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="<?php echo $product['quantity']; ?>" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label>Price (₱)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Update Product</button>
                    <a href="products.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>