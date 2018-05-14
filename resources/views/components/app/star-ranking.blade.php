@if($ranking % 2 == 0)
    @for($i = 0; $i < $ranking; $i += 2)
        <i class="on {{ font('star') }}"></i>
    @endfor
    @for($i = 0; $i < 10 - $ranking; $i += 2)
        <i class="on {{ font('star-o') }}"></i>
    @endfor
@else
    @for($i = 0; $i < $ranking - 1; $i += 2)
        <i class="on {{ font('star') }}"></i>
    @endfor
    <i class="on {{ font('star-half-o') }}"></i>
    @for($i = 0; $i < 10 - $ranking - 1; $i += 2)
        <i class="on {{ font('star-o') }}"></i>
    @endfor
@endif