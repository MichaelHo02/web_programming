<?php
session_start();

function saveToFile() {
    
}

function cmpByName($a, $b)
{
    return strcmp($a['name'], $b['name']);
}

function cmpByPrice($a, $b)
{
    return $a['price'] - $b['price'];
}

function cmpByTime($a, $b)
{
    return strtotime($a['created_time']) - strtotime($b['created_time']);
}

function cmpBySize($a, $b)
{

    if (count($a['sizes']) == 0) {
        $a['sizes'] = [];
    }

    if (count($b['sizes']) == 0) {
        $b['sizes'] = [];
    }

    return count($a['sizes']) - count($b['sizes']);
}

if (isset($_GET['submit']) && isset($_SESSION['products'])) {
    if ($_GET['sort'] == 'name') {
        usort($_SESSION['products'], "cmpByName");
    } else if ($_GET['sort'] == 'price') {
        usort($_SESSION['products'], "cmpByPrice");
    } else if ($_GET['sort'] == 'time') {
        usort($_SESSION['products'], "cmpByTime");
    } else if ($_GET['sort'] == 'sizes') {
        usort($_SESSION['products'], "cmpBySize");
    }
}
?>

<form action="display_product.php" method="get">
    <select name="sort" id="sort">
        <option value="name" <?php echo $_GET['sort'] == 'name' ? 'selected' : ''; ?>>Name</option>By Name</option>
        <option value="price" <?php echo $_GET['sort'] == 'price' ? 'selected' : ''; ?>>By Price</option>
        <option value="time" <?php echo $_GET['sort'] == 'time' ? 'selected' : ''; ?>>By Created Time</option>
        <option value="sizes" <?php echo $_GET['sort'] == 'sizes' ? 'selected' : ''; ?>>By the number of available sizes</option>
    </select>
    <input type="submit" name="submit" value="submit">
</form>

<?php
if (isset($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $product) {
        echo "
        <div>
            <h2>Product: {$product['name']}</h2>
            <p>$ {$product['price']}</p>
            <p>{$product['created_time']}</p>
            ";
        echo "<ul>";
        foreach ($product['sizes'] as $size) {
            echo "<li>{$size}</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}
?>