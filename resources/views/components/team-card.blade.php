<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
    <div class="designer fix">
        <div class="designer-img">
            <img src="{{ $team->image_path }}" alt="..." />
            <div class="designer-text">
                <h2>{{ $team->format_name }}</h2>
                <h3>{{ $team->format_function }}</h3>
                <p>{{ $team->format_description }}</p>
                <div class="designer-socials">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>