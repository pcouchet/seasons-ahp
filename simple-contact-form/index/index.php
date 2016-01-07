<?php echo head(); ?>
<div id="primary">
    <h2><?php echo html_escape(get_option('simple_contact_form_contact_page_title')); ?></h2>


	<?php echo get_option('simple_contact_form_contact_page_instructions'); // HTML ?>

	<?php echo flash(); ?>
	<form name="contact_form" id="contact-form"  method="post" enctype="multipart/form-data" accept-charset="utf-8">

        <fieldset>

        <div class="field">
		<?php
		    echo $this->formLabel('name', 'Votre Nom: ');
		    echo $this->formText('name', $name, array('class'=>'textinput')); ?>
		</div>

        <div class="field">
            <?php
                    echo $this->formLabel('email', 'Votre Email: ');
		    echo $this->formText('email', $email, array('class'=>'textinput'));  ?>
        </div>

		<div class="field">
		  <?php
		    echo $this->formLabel('message', 'Votre Message: ');
		    echo $this->formTextarea('message', $message, array('class'=>'textinput', 'rows' => '10')); ?>
		</div>

		</fieldset>

        <fieldset>
        <?php if ($captcha): ?>
        <div class="field">
            <?php echo $captcha; ?>
        </div>
        <?php endif; ?>

		<div class="field">
		  <?php echo $this->formSubmit('send', 'Envoyer le Message'); ?>
		</div>

	    </fieldset>
	</form>

</div>
<?php echo foot();
