<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<ul class="sidebar-menu">
		<!-- <li class="header">MAIN NAVIGATION</li> -->
		<li class="treeview">
			<a href="<?php echo WEB_ROOT; ?>views/?v=DB"><i class="fa fa-calendar"></i><span>agenda des rendez-vous</span></a>
		</li>
		<li class="treeview">
			<a href="<?php echo WEB_ROOT; ?>views/?v=LIST"><i class="fa fa-newspaper-o"></i><span>list des rendez-vous</span></a>
		</li>
		<?php
		$type = $_SESSION['calendar_fd_user']['fonction'];
		if ($type == 'manager') {
		?>
			<li class="treeview">
				<a href="<?php echo WEB_ROOT; ?>views/?v=USERS"><i class="fa fa-users"></i><span>list des utilisateurs</span></a>
			</li>
		<?php
		}
		?>
	</ul>
</section>
<!-- /.sidebar -->