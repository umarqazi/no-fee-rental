					<h3>Unit Features</h3>
					<ul class="checkbox-listing">
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('unit_feature[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem7']) !!}
								<label class="custom-control-label" for="listitem7">Furnished</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('unit_feature[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem8']) !!}
								<label class="custom-control-label" for="listitem8">Laundry In Unit</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('unit_feature[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem9']) !!}
								<label class="custom-control-label" for="listitem9">Parking Space</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('unit_feature[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem10']) !!}
								<label class="custom-control-label" for="listitem10">Outdoor Space</label>
							</div>
						</li>
					</ul>