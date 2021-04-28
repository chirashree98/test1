<form id="proSearch" action="<?php echo base_url('frontend/product/productsSearch'); ?>" method="post"> 
<div class="product-filder">
    <input type="hidden" id="fromshop" name="fromshop" value="<?= $urlsegment ?>">
    <h4>Filter By</h4>
    <h5>Categories</h5>
    <ul>
        <?php
        if ($category->num_rows() > 0) {
            foreach ($category->result() as $row) {
                ?>
        <li for="cat_search_<?php echo $row->id; ?>"><input type="radio" value="<?php echo $row->id; ?>" <?php if(isset($_SESSION['search']['cat_search']) && $_SESSION['search']['cat_search']==$row->id ){ ?> checked=""  <?php } ?> id="cat_search_<?php echo $row->id; ?>" name="cat_search"/> <?php echo $row->name; ?></li>
            <?php }
        }
        ?>
    </ul>
</div>
<div class="product-filder">
    <?php
    if ($parent_attribute->num_rows() > 0) {
        foreach ($parent_attribute->result() as $row) {
            ?>
            <h5><?php echo $row->attr_name; ?></h5> 
            <ul class="color-variant">
        <?php  foreach ($child_attribute->result() as $c_row) { if ($row->id == $c_row->parent_id) { ?>
                 <li ><input type="radio" <?php if(!empty($_SESSION['search']['attr_search']) && in_array($c_row->id, $_SESSION['search']['attr_search'], true) ){ ?> checked=""  <?php } ?> value="<?php echo $c_row->id; ?>"  name="attr_search[<?php echo $row->attr_name; ?>]"/> <?php echo $c_row->attr_name; ?></li>
        <?php } } ?>
            </ul>
        <?php }
    }
    ?>
</div>
    
    <!--<button type="submit" class="clean-all-btn">Save</button>-->
</form>

<a href="<?php echo base_url(); ?>remove_search?value=clear_all"><button class="clean-all-btn">Clean All</button></a>