<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Cambio Add</h3>
            </div>
            <?php echo form_open('cambio/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="gestion_id" class="control-label">Gestion</label>
						<div class="form-group">
							<select name="gestion_id" class="form-control">
								<option value="">select gestion</option>
								<?php 
								foreach($all_gestion as $gestion)
								{
									$selected = ($gestion['gestion_id'] == $this->input->post('gestion_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$gestion['gestion_id'].'" '.$selected.'>'.$gestion['gestion_nombre'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cambio_fecha" class="control-label">Cambio Fecha</label>
						<div class="form-group">
							<input type="text" name="cambio_fecha" value="<?php echo $this->input->post('cambio_fecha'); ?>" class="has-datepicker form-control" id="cambio_fecha" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="cambio_ufv" class="control-label">Cambio Ufv</label>
						<div class="form-group">
							<input type="text" name="cambio_ufv" value="<?php echo $this->input->post('cambio_ufv'); ?>" class="form-control" id="cambio_ufv" />
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>