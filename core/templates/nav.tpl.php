<nav>
	<ul>
		<?php foreach ($nav_array as $li_index => $li_value) : ?>
			<?php if ($li_value['visible']) : ?>
				<li>
					<a href="<?php print $li_value['path']; ?>">
						<?php print $li_index; ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</nav>