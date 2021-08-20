<select class="{{ $class }}" name="{{$name}}" title="{{ $name }}">
    @foreach($options as $opt)
        <option
            value="{{data_get($opt,'val')}}" {{$selected==data_get($opt,'val')?'selected':''}}>{{data_get($opt,'txt')}}</option>
    @endforeach
</select>
