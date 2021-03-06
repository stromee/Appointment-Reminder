<?php 
    if ($session->check('Message.flash')) {
        $session->flash();
    }
?>
<div id="company_details">
	<div class="company_info">
<?php
    echo 
    $form->create('Company', array('action' => 'admin_update', 'class' => 'editor_form')),
    $form->input('name', array('between' => '', 'label' => 'Company name', 'maxlength' => '50', 'size' => '50', 'after' => '<div id="slimitinfo" class="hint">Maximum of 50 characters.</div>')),
    $form->input('email', array('between' => '', 'label' => 'Company email', 'size' => '40', 'after' => '<div id="slimitinfo" class="hint">This is the email customers will reply to.</div>')),
    $form->input('phone', array('between' => '', 'label' => 'Company phone')),
    $form->input('website_url', array('between' => '', 'label' => 'Company website')),
    $form->input('payment_methods', array('multiple' => 'checkbox', 'type' => 'select', 'label' => 'Customer payment methods accepted', 'options' => $options, 'selected' => $selected));
    if($isAdmin) {
    	echo 
    	$form->input('status', array('label' => 'Company status')),
		$form->input('expire_date', array('label' => 'Subscription Expiration Date'));
	}
	echo $form->hidden('id');
	if(isset($this->params['url']['redirect'])) {
		echo $form->hidden('redirect', array('value' => $this->params['url']['redirect']));
	}
	?>
	<br />
	<?php
	$options = array(
    	'label' => 'Save',
    	'name' => 'Save',
    	'div' => array(
        	'class' => 'wf-form-button',
    		)
		);
	echo $form->end($options);
?> <span>or</span> <?php echo $html->link(__('Cancel', true), array('action' => 'index'), array('class' => 'cancel')); ?>
	</div>
</div>

<span class="cleaner"></span>

<?php $partialLayout->blockStart('sidebar'); ?>
	<div class="company_logo">
	<?php	
		if($this->data['Company']['logo_path']) {
			echo $html->image('uploads/companies/logos/big/'.$this->data['Company']['logo_path']);
		} else {
			echo $html->image('company.png');
		}
	?>
	<br />
	<?php	
		echo $html->link(__('Change Logo', true), array('action' => 'change_logo/' . $this->data['Company']['id'])); 
	?>
	</div>
	<br />
    <div class="company_photo">
	<?php	
		if($this->data['Company']['photo_path']) {
			echo $html->image('uploads/companies/photos/'.$this->data['Company']['photo_path'], array('width' => 250));
		} else {
			echo $html->image('company.png');
		}
	?>
	<br />
	<?php
	$thickbox->setProperties(array('id'=>'domId','type'=>'iframe','iframeUrl'=>'/admin/companies/upload_photo/'.$this->data['Company']['id'], 'title' => 'Change Company Photo'));
	$thickbox->setPreviewContent('Change Company Photo');
	echo $thickbox->output();
	?>
	</div>
<?php $partialLayout->blockEnd(); ?>
