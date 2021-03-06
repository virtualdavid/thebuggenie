<div class="backdrop_box large">
	<div class="backdrop_detail_header">
		<?php echo ($milestone->getId()) ? __('Edit milestone details') : __('Add milestone'); ?>
	</div>
	<div id="backdrop_detail_content" class="backdrop_detail_content">
		<form accept-charset="<?php echo TBGContext::getI18n()->getCharset(); ?>" action="<?php echo make_url('project_milestone', array('project_key' => $milestone->getProject()->getKey())); ?>" method="post" id="edit_milestone_form" onsubmit="TBG.Project.Milestone.<?php echo ($milestone->getID()) ? 'update' : 'add'; ?>('<?php echo make_url('project_milestone', array('project_key' => $milestone->getProject()->getKey())); ?>'<?php if ($milestone->getID()): ?>, <?php echo $milestone->getID(); ?><?php endif; ?>);return false;">
			<table style="width: 750px;" cellpadding=0 cellspacing=0>
				<tr>
					<td style="width: 150px;"><label for="milestone_name_<?php echo $milestone->getID(); ?>"><?php echo __('Name:'); ?></label></td>
					<td style="width: auto;"><input type="text" style="width: 100%;" value="<?php echo $milestone->getName(); ?>" name="name" id="milestone_name_<?php echo $milestone->getID(); ?>"></td>
				</tr>
				<tr>
					<td><label for="milestone_description_<?php echo $milestone->getID(); ?>"><?php echo __('Description:'); ?></label></td>
					<td style="width: auto;"><input type="text" style="width: 100%;" value="<?php echo $milestone->getDescription(); ?>" name="description" id="milestone_description_<?php echo $milestone->getID(); ?>"></td>
				</tr>
				<tr>
					<td><label for="milestone_visibility_roadmap_<?php echo $milestone->getID(); ?>"><?php echo __('Visibility:'); ?></label></td>
					<td style="width: auto;">
						<select name="visibility_roadmap" id="milestone_visibility_roadmap_<?php echo $milestone->getID(); ?>">
							<option value="0"<?php if (!$milestone->isVisibleRoadmap()): ?> selected<?php endif; ?>><?php echo __('Not visible on project roadmap'); ?></option>
							<option value="1"<?php if ($milestone->isVisibleRoadmap()): ?> selected<?php endif; ?>><?php echo __('Visible on project roadmap'); ?></option>
						</select>
						<select name="visibility_issues" id="milestone_visibility_issues_<?php echo $milestone->getID(); ?>">
							<option value="0"<?php if (!$milestone->isVisibleIssues()): ?> selected<?php endif; ?>><?php echo __('Not available for project issues'); ?></option>
							<option value="1"<?php if ($milestone->isVisibleIssues()): ?> selected<?php endif; ?>><?php echo __('Available for project issues'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 130px;">
						<select name="is_starting" id="starting_date_<?php echo $milestone->getID(); ?>" style="width: 100%;" onchange="if ($('starting_date_<?php echo $milestone->getID(); ?>').getValue() == '1') { $('starting_month_<?php echo $milestone->getID(); ?>').enable(); $('starting_day_<?php echo $milestone->getID(); ?>').enable(); $('starting_year_<?php echo $milestone->getID(); ?>').enable(); } else { $('starting_month_<?php echo $milestone->getID(); ?>').disable(); $('starting_day_<?php echo $milestone->getID(); ?>').disable(); $('starting_year_<?php echo $milestone->getID(); ?>').disable(); } ">
							<option value="0" <?php print ($milestone->hasStartingDate()) ? "" : " selected"; ?>><?php echo __('No planned start'); ?></option>
							<option value="1" <?php print (!$milestone->hasStartingDate()) ? "" : " selected"; ?>><?php echo __('Planned start'); ?></option>
						</select>
					</td>
					<td style="width: auto;">
						<select style="width: 90px;" name="starting_month" id="starting_month_<?php echo $milestone->getID(); ?>"<?php if (!$milestone->hasStartingDate()): ?> disabled<?php endif; ?>>
						<?php for ($cc = 1;$cc <= 12;$cc++): ?>
							<option value="<?php echo $cc; ?>" <?php if ($milestone->getStartingMonth() == $cc || (!$milestone->hasStartingDate() && $cc == date('m'))) echo " selected"; ?>><?php echo strftime('%B', mktime(0, 0, 0, $cc, 1)); ?></option>
						<?php endfor; ?>
						</select>
						<select style="width: 45px;" name="starting_day" id="starting_day_<?php echo $milestone->getID(); ?>"<?php if (!$milestone->hasStartingDate()): ?> disabled<?php endif; ?>>
						<?php for ($cc = 1;$cc <= 31;$cc++): ?>
							<option value="<?php echo $cc; ?>" <?php if ($milestone->getStartingDay() == $cc || (!$milestone->hasStartingDate() && $cc == date('d'))) echo " selected"; ?>><?php echo $cc; ?></option>
						<?php endfor; ?>
						</select>
						<select style="width: 60px;" name="starting_year" id="starting_year_<?php echo $milestone->getID(); ?>"<?php if (!$milestone->hasStartingDate()): ?> disabled<?php endif; ?>>
						<?php for ($cc = 1990;$cc <= (date("Y") + 10);$cc++): ?>
							<option value="<?php echo $cc; ?>" <?php if ($milestone->getStartingYear() == $cc || (!$milestone->hasStartingDate() && $cc == date('Y'))) echo " selected"; ?>><?php echo $cc; ?></option>
						<?php endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 130px;">
						<select name="is_scheduled" id="sch_date_<?php echo $milestone->getID(); ?>" style="width: 100%;" onchange="if ($('sch_date_<?php echo $milestone->getID(); ?>').getValue() == '1') { $('sch_month_<?php echo $milestone->getID(); ?>').enable(); $('sch_day_<?php echo $milestone->getID(); ?>').enable(); $('sch_year_<?php echo $milestone->getID(); ?>').enable(); } else { $('sch_month_<?php echo $milestone->getID(); ?>').disable(); $('sch_day_<?php echo $milestone->getID(); ?>').disable(); $('sch_year_<?php echo $milestone->getID(); ?>').disable(); } ">
							<option value="0" <?php print ($milestone->hasScheduledDate()) ? "" : " selected"; ?>><?php echo __('No planned milestone'); ?></option>
							<option value="1" <?php print (!$milestone->hasScheduledDate()) ? "" : " selected"; ?>><?php echo __('Planned milestone'); ?></option>
						</select>
					</td>
					<td style="width: auto;">
						<select style="width: 90px;" name="sch_month" id="sch_month_<?php echo $milestone->getID(); ?>" <?php print (!$milestone->hasScheduledDate()) ? "disabled" : ""; ?>>
						<?php for ($cc = 1;$cc <= 12;$cc++): ?>
							<option value="<?php echo $cc; ?>" <?php if ($milestone->getScheduledMonth() == $cc || (!$milestone->hasScheduledDate() && $cc == date('m'))) echo " selected"; ?>><?php echo strftime('%B', mktime(0, 0, 0, $cc, 1)); ?></option>
						<?php endfor; ?>
						</select>
						<select style="width: 45px;" name="sch_day" id="sch_day_<?php echo $milestone->getID(); ?>" <?php print (!$milestone->hasScheduledDate()) ? "disabled" : ""; ?>>
						<?php for ($cc = 1;$cc <= 31;$cc++): ?>
							<option value="<?php echo $cc; ?>" <?php if ($milestone->getScheduledDay() == $cc || (!$milestone->hasScheduledDate() && $cc == date('d'))) echo " selected"; ?>><?php echo $cc; ?></option>
						<?php endfor; ?>
						</select>
						<select style="width: 60px;" name="sch_year" id="sch_year_<?php echo $milestone->getID(); ?>" <?php print (!$milestone->hasScheduledDate()) ? "disabled" : ""; ?>>
						<?php for ($cc = 1990;$cc <= (date("Y") + 10);$cc++): ?>
							<option value="<?php echo $cc; ?>" <?php if ($milestone->getScheduledYear() == $cc || (!$milestone->hasScheduledDate() && $cc == date('Y'))) echo " selected"; ?>><?php echo $cc; ?></option>
						<?php endfor; ?>
						</select>
					</td>
				</tr>
			</table>
			<table style="clear: both; width: 780px;" class="padded_table" cellpadding=0 cellspacing=0>
				<tr>
					<td colspan="2" style="padding: 10px 0 10px 10px; text-align: right;">
						<div style="float: left; font-size: 13px; padding-top: 2px; font-style: italic;" class="config_explanation">
							<?php if ($milestone->getId()): ?>
								<?php echo __('When you are done, click "%update_milestone" to update the details for this milestone', array('%update_milestone' => __('Update milestone'))); ?>
							<?php else: ?>
								<?php echo __('When you are done, click "%add_milestone" to publish this milestone', array('%add_milestone' => __('Add milestone'))); ?>
							<?php endif; ?>
						</div>
						<?php if ($milestone->getID()): ?>
							<input type="hidden" name="milestone_id" value="<?php echo $milestone->getID(); ?>">
						<?php endif; ?>
						<input class="button button-green" style="float: right;" type="submit" value="<?php echo ($milestone->getId()) ? __('Update milestone') : __('Add milestone'); ?>">
						<span id="milestone_edit_indicator" style="display: none; float: right;"><?php echo image_tag('spinning_20.gif'); ?></span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="backdrop_detail_footer">
		<?php echo javascript_link_tag(__('Close popup'), array('onclick' => 'TBG.Main.Helpers.Backdrop.reset();')); ?>
	</div>
</div>
