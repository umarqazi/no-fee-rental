					<h3>Building Features</h3>
					<ul class="checkbox-listing">
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('building_feature[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem11']) !!}
								<label class="custom-control-label" for="listitem11">Door Man</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('building_feature[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem12']) !!}
								<label class="custom-control-label" for="listitem12">Fitness Center</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('building_feature[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem13']) !!}
								<label class="custom-control-label" for="listitem13">Storage Facility</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('building_feature[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem14']) !!}
								<label class="custom-control-label" for="listitem14">Elevator</label>
							</div>
						</li>
					</ul>