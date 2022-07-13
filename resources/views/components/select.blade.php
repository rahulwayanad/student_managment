@props(['options','selected_option','name'])

<select name='$name' placeholder='Select'>
    @foreach($options as $key => $value)
        <option @if($key == $selected_option){{'selected'}} @endif key='{{ $key }}' value='{{ $value }}'></option>
    @endforeach
</select>
