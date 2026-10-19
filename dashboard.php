<?php
include_once 'header.php';
require_once 'db.php';

// Kunin ang total counts mula sa database
$prod_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn() ?: 0;
$cat_count = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn() ?: 0;
$sup_count = $pdo->query("SELECT COUNT(*) FROM suppliers")->fetchColumn() ?: 0;
$total_stock = $pdo->query("SELECT SUM(quantity) FROM products")->fetchColumn() ?: 0;
?>

<!-- Custom Purple Styling -->
<style>
    .bg-purple {
        background-color: #6f42c1 !important;
    }
</style>

<div class="mb-4">
    <h2 class="fw-bold" style="color: #6f42c1;">Dashboard</h2>
    <p class="text-muted">Welcome to your Inventory Management System dashboard.</p>
</div>

<!-- Summary Cards na Kulay Purple -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 bg-purple text-white">
            <div class="card-body">
                <h6 class="text-uppercase opacity-75">Total Products</h6>
                <h2 class="fw-bold mb-0"><?php echo $prod_count; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-white" style="background-color: #8540f5;">
            <div class="card-body">
                <h6 class="text-uppercase opacity-75">Total Categories</h6>
                <h2 class="fw-bold mb-0"><?php echo $cat_count; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-white" style="background-color: #5a32a3;">
            <div class="card-body">
                <h6 class="text-uppercase opacity-75">Total Suppliers</h6>
                <h2 class="fw-bold mb-0"><?php echo $sup_count; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 text-white" style="background-color: #9c6ade;">
            <div class="card-body">
                <h6 class="text-uppercase opacity-75">Total Stock Qty</h6>
                <h2 class="fw-bold mb-0"><?php echo $total_stock; ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-2">Quick Navigation</h5>
        <p class="text-muted mb-0">Use the menu above to add, update, or delete products, categories, and suppliers.</p>
    </div>
</div>

<?php include_once 'footer.php'; ?>