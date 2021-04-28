<?php foreach ($pick_up_address as $value) { ?>
    <p>
<?= !empty($value['name']) ? $value['name'] : '' ?>
<?= !empty($value['company_name']) ? ' '.$value['company_name'] : '' ?>
<?= !empty($value['address2']) ? ', '.$value['address2'] : '' ?>
<?= !empty($value['postcode']) ? ', '.$value['postcode'] : '' ?>
<?= !empty($value['city']) ? ', '.$value['city'] : '' ?>
<?= !empty($value['state_name']) ? ', '.$value['state_name'] : '' ?>
<?= !empty($value['country_name']) ? ', '.$value['country_name'] : '' ?>
<?= !empty($value['email']) ? ', '.$value['email'] : '' ?>
<?= !empty($value['std_code']) ? ', '.$value['std_code'] : '' ?>
<?= !empty($value['phone']) ? ' '.$value['phone'] : '' ?>
</p>
<?php } ?>
