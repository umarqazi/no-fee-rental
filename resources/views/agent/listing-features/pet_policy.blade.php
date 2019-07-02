					<h3>Pet Policy</h3>
					<ul class="checkbox-listing">
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('pet_policy[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem5']) !!}
								<label class="custom-control-label" for="listitem5">Cats Allowed</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('pet_policy[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem6']) !!}
								<label class="custom-control-label" for="listitem6">Dogs Allowed</label>
							</div>
						</li>
					</ul>