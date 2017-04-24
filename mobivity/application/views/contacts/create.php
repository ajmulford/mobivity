<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('contacts/create'); ?>

    <label for="title">Full Name</label>
    <input type="input" name="fullName" /><br />

    <label for="text">Company</label>
    <?php echo form_dropdown('companies', $companies);?><br />

    <label for="text">Phone Number</label>
    <input type="input" name="phone" /><br />

    <label for="text">Email</label>
    <input type="input" name="email" /><br />

    <label for="text">Country</label>
    <?php echo form_dropdown('country', $countries, '38');?><br>

    <input type="submit" name="submit" value="Create contact" />

</form>