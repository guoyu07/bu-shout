<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Shout - comments</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
</head>
<body>
<div id="header"></div>
<div id="pane">

<div id="left_col">

	<div id="left_top" class="rounded">
		<?php echo anchor('shout', "<img src='" . base_url() . "css/logo.gif' />"); ?>
	</div>
	<div id="left_bottom" class="rounded">
	
	<div class="notice">So whatcha think?  Share it.</div>
	
	<?php
	
		$form_attributes = array('id' => 'shout_form');
		$hidden_fields = array('submission_id' => $submission_id);

		echo form_open('shout/detail/' . $submission_id, $form_attributes, $hidden_fields);
		echo form_label('Comment', 'body', array('class' => 'form_label') );
		echo form_error('body', "<span class='error_msg'>", '</span>');
		echo "<br />";
		echo form_textarea( array('name' => 'body', 'value' => set_value('body'), 'class' => 'form_textarea' ) );
		echo "<br />";
		echo form_input( array('name' => 'human', 'id' => 'human') );
		echo form_submit( array('value' => 'Share It') );
		echo form_close();

	?>

	</div>
</div>

<div id="right_col" class="rounded">
<div id="col_scroll">
	<div id="shout_detail" class="rounded">
		<div id="shout_title"><?php echo $shout->row()->title; ?></div>
		<div id="shout_date">
			<?php echo get_friendly_date(strtotime($shout->row()->date));  ?>
		</div>

		<div id="shout_body"><?php echo $shout->row()->body; ?></div>
	</div>
	
	<?php if($comments->num_rows() > 0): ?>
		
		<?php foreach($comments->result() as $comment): ?>
		
			<div class="comment">
				<?php
					if($this->session->userdata('username'))
					{
						echo anchor('/shout/admin/delete_comment/' . $comment->id, 'delete', array('class'=>'admin_action'));
					}
					
					echo "<span class='date'>" . get_friendly_date(strtotime($comment->date)) . "</span>";
					echo "<div class='body'>" . $comment->body . "</div>";
					
					echo '&nbsp;';
					
				?>
			</div>
		
		<?php endforeach; ?>
	<?php
		else:
			echo "<div class='comment'>" . 'There are no comments &hellip; yet!' . "</div>";
		endif;
	?>
</div>

	<?php echo $pageNavLinks; ?>
	
</div>
</div>
<div id="footer"></div>

<?php $this->load->view('_footer') ?>

</body>
</html>