@extends('admin.layouts.admin')

@section('home.title', page_title('Tableau de bord'))

@section('home.body')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <a href="{{ route('admin.orders.index') }}" title="Voir plus de détails">
                                <i class="{{ font('dollar') }} text-danger fa-3x"></i>
                            </a>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Revenue total</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ money_currency($incomes) }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="{{ font('warning') }} mr-1" aria-hidden="true"></i>
                        {{ money_currency($monthly_incomes) }} ce mois
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <a href="{{ route('admin.orders.index') }}" title="Voir plus de détails">
                                <i class="{{ font('copy') }} text-warning fa-3x"></i>
                            </a>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Commandes</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $orders_nbr }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="{{ font('warning') }} mr-1" aria-hidden="true"></i>
                        {{ $monthly_orders_nbr }} ce mois
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <a href="{{ route('admin.customers.index') }}" title="Voir plus de détails">
                                <i class="{{ font('cubes') }} text-success fa-3x"></i>
                            </a>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Clients</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $customers_nbr }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="{{ font('warning') }} mr-1" aria-hidden="true"></i>
                        {{ $monthly_customers_nbr }} ce mois
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <a href="{{ route('admin.contacts.index') }}" title="Voir plus de détails">
                                <i class="{{ font('envelope') }}  text-info fa-3x"></i>
                            </a>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Méssages</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $messages_nbr }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="{{ font('warning') }} mr-1" aria-hidden="true"></i>
                        {{ $monthly_messages_nbr }} ce mois
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">REVENUES DE {{ now()->year }}</h4>
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">COMMANDES</h4>
                    <canvas id="orderChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CLIENTS</h4>
                    <canvas id="customerChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">PRODUITS EN STOCK</h4>
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_admin_asset('dashboard') }}" type="text/javascript"></script>
@endpush