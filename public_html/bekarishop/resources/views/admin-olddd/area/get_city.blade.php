<option value="" disabled="" selected="">----Select City----</option>
@foreach($cities as $citiy)
<option value="{{$citiy->id}}">
	@php echo $citiy->name; @endphp
</option>
@endforeach
