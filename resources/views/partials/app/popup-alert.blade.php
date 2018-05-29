@if(session()->has('notification.message'))
    <script src="{{ js_asset('bootstrap-notify.min') }}" type="text/javascript"></script>
    <script> 
        notification(
            "{{ session('notification.title') }}", 
            "{{ session('notification.message') }}", 
            "{{ session('notification.type') }}", 
            "{{ session('notification.icon') }}", 
            "{{ session('notification.animate.enter') }}", 
            "{{ session('notification.animate.exit') }}", 
            "{{ session('notification.delay') }}"
        );
    </script>
@endif