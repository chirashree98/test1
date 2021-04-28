<ul>
    <!--<li <?php if($this->uri->segment(1)=="artist_account"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>artist_account">View Profile</a></li>-->
	 <li <?php if($this->uri->segment(1)=="my_account"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>my_account">My Account</a></li>
     <li <?php if($this->uri->segment(1)=="artist_edit_profile"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>artist_edit_profile">Edit Profile</a></li>
    <li <?php if($this->uri->segment(1)=="artist_edit_account"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>artist_edit_account">Edit Service Profile</a></li>
    <li <?php if($this->uri->segment(1)=="artist-changepassword"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>artist-changepassword">Change Password</a></li>
	<li <?php if($this->uri->segment(1)=="edit_bank"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>edit_bank">Bank Account Details</a></li>
     <li <?php if($this->uri->segment(1)=="all_quotes"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>all_quotes">Received Quotes</a></li>
    <li<?= ($this->uri->segment(1) == "request-ad") ? ' class="active"' : ''?>><a href="<?= base_url('request-ad');?>">Accept/Decline Request</a></li>
    <li<?= ($this->uri->segment(1) == "artist-transaction-history") ? ' class="active"' : ''?>><a href="<?= base_url('artist-transaction-history');?>">Transaction History</a></li>
    <li<?= ($this->uri->segment(1) == "artist-canceled-transaction") ? ' class="active"' : ''?>><a href="<?= base_url('artist-canceled-transaction');?>">Canceled Transactions</a></li>
	
        <li <?= ($this->uri->segment(1) == "emails") ? ' class="active"' : '' ?>><a href="<?php echo base_url(); ?>emails">Contact Main Studio</a></li>
    
      <li <?php if($this->uri->segment(1)=="user_newsletters"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>user_newsletters">Newsletter</a></li>
    
    <li <?php if($this->uri->segment(1)=="all_work_samples"){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>all_work_samples">All Work Samples</a></li>
    <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
</ul>