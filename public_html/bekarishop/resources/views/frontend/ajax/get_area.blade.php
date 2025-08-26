<option value="" disabled="" selected=""> Select a area </option>
@foreach($areas as $area)
<option value="{{$area->id}}">
	@php echo $area->name; @endphp
</option>
@endforeach
