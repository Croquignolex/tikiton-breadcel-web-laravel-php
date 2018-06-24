<!-- Start modal -->
<form id="{{ $id }}" action="{{ $route }}" method="POST" class="hidden">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
<!-- End modal -->