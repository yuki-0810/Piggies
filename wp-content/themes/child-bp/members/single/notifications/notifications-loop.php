<table class="notifications">
	<thead>
		<tr>
		</tr>
	</thead>

	<tbody>

		<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>

			<tr>
				<td><img id="member-table-img" src="<?php echo get_stylesheet_directory_uri(); ?>/resources/images/logo1.png"/></td>
				<td><?php bp_the_notification_description();  ?></td>
			</tr>

		<?php endwhile; ?>

	</tbody>
</table>
