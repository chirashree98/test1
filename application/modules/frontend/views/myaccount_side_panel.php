<ul>
    <?php if ($this->session->userdata('USER_TYPE') == '6') { ?>
        <li <?= ($this->uri->segment(1) == "store_account") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>store_account">My Account</a></li>
    <?php } else if ($this->session->userdata('USER_TYPE') == '4') { ?>
        <li <?= ($this->uri->segment(1) == "account") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>account">My Account</a></li>
    <?php } else if ($this->session->userdata('USER_TYPE') == '1') { ?>̥
        <li <?= ($this->uri->segment(1) == "artist_edit_profile") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>artist_edit_profile">My Account</a></li>
    <?php } ?>

    <li <?= ($this->uri->segment(1) == "edit-account") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>edit-account">Edit Account</a></li>
    <?php if ($this->session->userdata('USER_TYPE') == '6') { ?>
        <li  <?= ($this->uri->segment(1) == "edit-service") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>edit-service">Edit Store Page</a></li>
    <?php } ?>
    <li <?= ($this->uri->segment(1) == "change-password") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>change-password">Change Password</a></li>

    <?php if (($this->session->userdata('USER_TYPE') == '6')){ ?>
        <li<?= ($this->uri->segment(1) == "edit_pickup") ? ' class="active"' : '' ?>><a href="<?php echo base_url('edit_pickup/'.$this->session->userdata('USER_ID')); ?>">Delivery Method</a></li>
    <?php } ?>
		<?php
    if (($this->session->userdata('USER_TYPE') != '6')){
							//$user_id = $this->session->userdata('USER_ID');
	?>
	
	    <li<?= ($this->uri->segment(1) == "all-addressbook") ? ' class="active"' : '' ?>><a
    href="<?php echo base_url(); ?>all-addressbook">Address Book</a></li>
	
	
	<?php
	}?>
	
	<?php
    if (($this->session->userdata('USER_TYPE') != '6') && ($this->session->userdata('USER_TYPE') != '1')) { ?>
    <li<?= ($this->uri->segment(1) == "my-design-requests") ? ' class="active"' : '' ?>><a
                href="<?= base_url('my-design-requests') ?>">Design requests</a></li>
				 <?php } ?>
    <?php
    if (($this->session->userdata('USER_TYPE') != '6') && ($this->session->userdata('USER_TYPE') != '1')) { ?>
        <li <?= ($this->uri->segment(1) == "wishlists") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>wishlists">Wishlist</a></li>
    <?php } ?>
   
    <?php if ($this->session->userdata('USER_TYPE') == '4') { ?>
        <li <?= ($this->uri->segment(1) == "order-history") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>order-history">Order History</a></li>
    <?php } ?>
	<?php if ($this->session->userdata('USER_TYPE') == '6' && $this->session->userdata('membership_id') == '1') { ?>
        <li <?= ($this->uri->segment(1) == "all_products") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>all_products">All Products</a></li>
    <?php } ?>

	<?php
    if (($this->session->userdata('USER_TYPE') == '6')){
							//$user_id = $this->session->userdata('USER_ID');
	?>
    <li <?= ($this->uri->segment(1) == "edit_banks") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>edit_banks">Bank Account details</a></li>
	<?php 
	  }?>
    <?php
    if (($this->session->userdata('USER_TYPE') == '6')) {
        //$user_id = $this->session->userdata('USER_ID');
        ?>
        <li<?= ($this->uri->segment(1) == "store-transaction-history") ? ' class="active"' : ''?>><a href="<?= base_url('store-transaction-history');?>">Transaction History</a></li>
        <?php
    } ?>
    <?php if ($this->session->userdata('USER_TYPE') == '6') { ?>
        <li <?= ($this->uri->segment(1) == "store-order-history") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>store-order-history">Orders</a></li>
    <?php } ?>
	<?php if ($this->session->userdata('USER_TYPE') == '6') { ?>
        <li <?= ($this->uri->segment(1) == "email") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>email">Contact Main Studio</a></li>
    <?php } ?>
    <li <?= ($this->uri->segment(1) == "user-newsletter") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>user-newsletter">Newsletter</a></li>
    <li  <?= ($this->uri->segment(1) == "logout") ? ' class="active"' : '' ?>class="bbnone"><a href="<?php echo base_url(); ?>logout">Logout</a></li>
</ul>


