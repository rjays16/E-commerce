<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<a href="/Tutorial/admin/index.php" class="navbar-brand">Shauta's Botique Admin</a>
		<ul class="nav navbar-nav">
			<!-- Menu Items -->
			<li><a href="brands.php">Brands</li></a>
			<li><a href="categories.php">Categories</li></a>
			<li><a href="products.php">Products</li></a>
			<li><a href="archieve.php">Archived</a></li>
			<?php if(has_permission('admin')): ?>
			<li><a href="users.php">Users</a></li>
			<?php endif;  ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['first']; ?><span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="change_password.php">Change Password</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</li>
		</div>
	</nav>