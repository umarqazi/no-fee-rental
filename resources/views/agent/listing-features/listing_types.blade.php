					<h3>Listing Type</h3>
					<ul class="checkbox-listing">
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('listing_type[]', 1, null, ['class' => 'custom-control-input', 'id' => 'listitem1']) !!}
								<label class="custom-control-label" for="listitem1">By Owner</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('listing_type[]', 2, null, ['class' => 'custom-control-input', 'id' => 'listitem2']) !!}
								<label class="custom-control-label" for="listitem2">Exclusive</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('listing_type[]', 3, null, ['class' => 'custom-control-input', 'id' => 'listitem3']) !!}
								<label class="custom-control-label" for="listitem3">No Fee</label>
							</div>
						</li>
						<li>
							<div class="custom-control custom-checkbox">
								{!! Form::checkbox('listing_type[]', 4, null, ['class' => 'custom-control-input', 'id' => 'listitem4']) !!}
								<label class="custom-control-label" for="listitem4">Exclusive</label>
							</div>
						</li>
					</ul>