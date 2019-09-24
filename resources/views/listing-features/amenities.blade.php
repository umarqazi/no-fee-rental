
@php $i = 1; @endphp
@foreach(features() as $key => $values)
    <div class="col-md-6">
        <h3>{{ucwords(str_replace('_', ' ', $key))}}</h3>
        <ul class="checkbox-listing">
            @foreach($values as $id => $f)
                @php $i ++; $id ++; @endphp
                 <li>
                     <div class="custom-control custom-checkbox">
                         {!! Form::checkbox("amenities[$key][]", $id, null,
                            [
                                ($action == 'Update') ? 'disabled' : '',
                                'class' => 'custom-control-input',
                                'id' => "listitem{$i}"
                            ]) !!}
                         <label class="custom-control-label" for="listitem{{$i}}">{{$f}}</label>
                     </div>
                 </li>
            @endforeach
        </ul>
    </div>
@endforeach
