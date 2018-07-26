<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ mb_strtoupper($table_label) }} ({{ $paginationTools->displayItems->count() }} sur {{ $paginationTools->itemsNumber }})</h4>
        @component('components.pagination',
            ['paginationTools' => $paginationTools])
        @endcomponent
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="table-secondary">
                    @foreach($headers as $header)
                        <th>{{ mb_strtoupper($header) }}</th>
                    @endforeach
                        <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>