	<h2 class="section">Please choose a company group photo.</h2>
	<?php 
	if ($session->check('Message.flash')) {
	    $session->flash();
	}
	?>
	<?php echo $form->create('Company', array('action' => 'crop_image', "enctype" => "multipart/form-data"));?> 
    <?php 
    	echo $form->hidden('id'); 
        echo $form->input('image',array("type" => "file"));  
        echo $form->end('Upload'); 
    ?>