<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php if($action == 'edit-form') { ?>
	<h1><span><?=t('Edit Public Set')?></span></h1>
	<div class="ccm-dashboard-inner">
		<form method="post" id="file_sets_edit" action="<?=$this->url('/dashboard/files/sets', 'file_sets_edit')?>">
			<?=$validation_token->output('file_sets_edit');?>
			<table class="entry-form" border="0" cellspacing="1" cellpadding="0">
				<tbody>
					<tr>
						<td class="subheader">Name</td>
					</tr>
					<tr>
						<td><?=$form->text('file_set_name',$file_set->fsName,array('style'=>'width:99%'));?></td>
					</tr>
					<tr>
						<td class="header">
						<?=$concrete_interface->submit(t('Update'), 'file_sets_edit');?>
						<?=$concrete_interface->button(t('Cancel'), $this->url('/dashboard/files/sets'), 'left');?>						
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				echo $form->hidden('fsID',$file_set->fsID);
			?>
		</form>
	</div>
<?php } else { ?>
	<h1><span><?=t('Public File Sets')?></span></h1>
		<div class="ccm-dashboard-inner">
		<div style="margin:0px; padding:0px; width:100%; height:auto" >	
			<form method="post" id="file-sets-edit-or-delete" action="<?=$this->url('/dashboard/files/sets', 'file_sets_edit_or_delete')?>">	
				<?=$validation_token->output('file_sets_edit_or_delete');?>
				<table border="0" cellspacing="1" cellpadding="0" class="grid-list" width="600">
					<tr>
						<td class="subheader" width="100%">Name</td>	
						<td class="subheader"><div style="width: 90px"></div></td>
						<td class="subheader"><div style="width: 60px"></div></td>
					</tr>
					<? foreach($file_sets as $set) { ?>
					<tr>
						<td><?=$set->fsName?></td>
						<td>
							<?php
								$b1 = $concrete_interface->button_js(t('Edit'), 'editFileSet('.$set->fsID.')');
								print $concrete_interface->buttons($b1);
							?>									
						</td>
						<td>
							<?php
								$b1 = $concrete_interface->button_js(t('Delete'), 'deleteFileSet('.$set->fsID.')');
								print $concrete_interface->buttons($b1);
							?>									
						</td>
					</tr>	
					<? } ?>
					<?=$form->hidden('fsID');?>
					<?=$form->hidden('file-sets-edit-or-delete-action');?>
				</table>
			</form>			
		</div>
	</div>
	
	<h1><span><?=t('Add Public Set')?></span></h1>
	<div class="ccm-dashboard-inner">
		<form method="post" id="file-sets-add" action="<?=$this->url('/dashboard/files/sets', 'file_sets_add')?>">
			<?=$validation_token->output('file_sets_add');?>
			<table class="entry-form" border="0" cellspacing="1" cellpadding="0">
				<tbody>
					<tr>
						<td class="subheader">Name</td>
					</tr>
					<tr>
						<td><?=$form->text('file_set_name','',array('style'=>'width:99%'));?></td>
					</tr>
					<tr>
						<td class="header">
						<?php
							$b1 = $concrete_interface->submit(t('Add'), 'file-sets-add');
							print $concrete_interface->buttons($b1);
						?>					
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	
	<script type="text/javascript">
		var editFileSet = function(fsID){	
			//set id
			$('#fsID').attr('value',fsID);		
			$('#file-sets-edit-or-delete-action').attr('value','edit-form');
			//submit form
			$("#file-sets-edit-or-delete").get(0).submit();		
		}
		
		var deleteFileSet = function(fsID){
			//set id
			$('#fsID').attr('value',fsID);		
			$('#file-sets-edit-or-delete-action').attr('value','delete');		
			if(confirm("<?=t('Are you sure you want to delete this file set?')?>")){
				$("#file-sets-edit-or-delete").get(0).submit();
			}
		}
	</script>
<?php } ?>	