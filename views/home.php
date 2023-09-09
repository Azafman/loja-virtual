<div class="row">
	<?php
	$a = 0;
	?>
	<?php foreach ($products as $product_item) : ?>
		<div class="col-sm-4">
			<?php $this->loadView('components/product-item', $product_item); ?>
			<?php #var_dump($product_item)?>
		</div>
		<?php
		/* BAGUNÇA NO CÓDIGO NÃO FAÇA ISSO, tenha um código limpo. */
		if ($a >= 2) {
			$a = 0;
			echo '</div><div class="row">';
		} else {
			$a++;
		}
		?>
	<?php endforeach; ?>
</div>
<div class="paginationArea">
	<?php for ($q = 1; $q <= $numberOfpages; $q++) : ?>
		<div class="paginationItem <?php if($currentPage == $q) echo 'pag_active'?>">
			<a href="?p=<?= $q ?>">
				<?= $q ?>
			</a>
		</div>
	<?php endfor; ?>
</div>