
@php $i = 1; @endphp
@foreach(features() as $key => $values)
    <div class="col-md-6">
        <h3>{{ucwords(str_replace('_', ' ', $key))}}</h3>
        <ul class="checkbox-listing">
            @foreach($values as $id => $f)
                @php $id += 1; $i += 1; @endphp
                @if($id == 6)
        </ul></div><div class="col-md-6"><ul class="checkbox-listing" style="margin-top: 28px;">
            @endif
            <li>
                <div class="custom-control custom-checkbox">
                    {!! Form::checkbox($key.'[]', $id, null, ['class' => 'custom-control-input', 'id' => "listitem{$i}"]) !!}
                    <label class="custom-control-label" for="listitem{{$i}}">{{$f}}</label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
@endforeach
