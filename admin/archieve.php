<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Tutorial/core/init.php';
if (!is_logged_in()) {
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM products WHERE deleted = 1";
$presults = $db->query($sql);

if (isset($_GET['featured'])) {
	$id = (int)$_GET['id'];
	$featured = (int)$_GET['featured'];
	$featuredSql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featuredSql);
	header('Location: archieve.php');
}


if (isset($_GET['archieve'])) {
	$id = (int)$_GET['id'];
	$archieve = (int)$_GET['archieve'];
	$sql2 = "UPDATE products SET deleted = '$archieve' WHERE id = '$id'";
	$db->query($sql2);
	header('Location: archieve.php');
}
?>
<h2 class="text-center">Archieved Products</h2>
<hr>

<table class="table table-bordered table-condensed table-striped">
	<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th></thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($presults)) : 
			$childID = $product['categories'];
			$catSql = "SELECT * FROM categories WHERE id = '$childID'";
			$result = $db->query($catSql);
			$child = mysqli_fetch_assoc($result);
			$parentID = $child['parent'];
			$pSql = "SELECT * FROM categories WHERE id = '$parentID'";
			$presult = $db->query($pSql);
			$parent = mysqli_fetch_assoc($presult);
			$category = $parent['category'].'~'.$child['category'];
		?>
		<tr>
			<td>
				<a href="archieve.php?archieve=<?=(($product['id'] == 0)?'1':'0'); ?>&id=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon  glyphicon-refresh"></span></a>
			</td>
			<td><?= $product['title']; ?></td>
			<td><?= money($product['price']) ;?></td>
			<td><?= $category; ?></td>
			<td><a href="archieve.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-<?=(($product['featured'] == 1)?'minus':'plus'); ?>"></span>
				</a>&nbsp <?=(($product['featured'] == 1)?'Featured Product':''); ?></td>
			<td>0</td>

		</tr>
	<?php endwhile; ?>
	</tbody>
</table>
<?php include 'includes/footer.php'; ?>
