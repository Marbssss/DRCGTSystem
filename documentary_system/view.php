<?php
$transaction = $_GET['transaction'] ?? 'Unknown';
$requirements = [
    "Cash Advances" => [
        "Approved Disbursement Voucher",
        "Letter Request",
        "Obligation Request (ObR)",
        "Certification of Availability of Funds",
        "Supporting Documents per COA Circular 2012-001"
    ],
    "Procurement" => [
        "Abstract of Bids",
        "Purchase Request",
        "Purchase Order",
        "Supplier’s Invoice",
        "Delivery Receipt"
    ]
];
$list = $requirements[$transaction] ?? ["No data available"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $transaction; ?> Requirements</title>
<style>
    body { font-family: Arial; background: #f7f9fc; padding: 40px; }
    .container { background: white; padding: 30px; border-radius: 10px; max-width: 700px; margin: auto; box-shadow: 0 3px 10px rgba(0,0,0,0.2); }
    h2 { color: #004aad; text-align: center; }
    .req-item { margin: 10px 0; }
    label { cursor: pointer; }
    .btn { margin-top: 20px; background: #004aad; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }
    .btn:hover { background: #00357d; }
</style>
</head>
<body>
<div class="container">
    <h2><?php echo $transaction; ?> Documentary Requirements</h2>
    <form>
        <?php foreach($list as $item): ?>
            <div class="req-item"><input type="checkbox" id="<?php echo $item; ?>"><label for="<?php echo $item; ?>"> <?php echo $item; ?></label></div>
        <?php endforeach; ?>
        <button type="button" class="btn" onclick="window.location.href='requirements.php'">Back</button>
    </form>
</div>
HI!
</body>
</html>
