$(function() {
    'use strict';

    const COLORS = [
        {background: 'rgba(255, 99, 132, 0.2)', border: 'rgba(255, 99, 132, 1)', hover: 'rgba(255, 99, 132, 0.5)'},
        {background: 'rgba(255, 159, 64, 0.2)', border: 'rgba(255, 159, 64, 1)', hover: 'rgba(255, 159, 64, 0.5)'},
        {background: 'rgba(255, 205, 86, 0.2)', border: 'rgba(255, 205, 86, 1)', hover: 'rgba(255, 205, 86, 0.5)'},
        {background: 'rgba(75, 192, 192, 0.2)', border: 'rgba(75, 192, 192, 1)', hover: 'rgba(75, 192, 192, 0.5)'},
        {background: 'rgba(54, 162, 235, 0.2)', border: 'rgba(54, 162, 235, 1)', hover: 'rgba(54, 162, 235, 0.5)'},
        {background: 'rgba(153, 102, 255, 0.2)', border: 'rgba(153, 102, 255, 1)', hover: 'rgba(153, 102, 255, 0.5)'},
        {background: 'rgba(201, 203, 207, 0.2)', border: 'rgba(201, 203, 207, 1)', hover: 'rgba(201, 203, 207, 0.5)'},
        {background: 'rgba(0, 0, 0, 0.2)', border: 'rgba(0, 0, 0, 1)', hover: 'rgba(0, 0, 0, 0.5)'},
    ];

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'GET',
        url: '/admin/dashboard/fill',
        dataType: "json"
    })
    .done(function(response) {
        let stockData = [];
        let stockLabels = [];
        let ordersData = [response.ordered_orders, response.progress_orders, response.sold_orders, response.canceled_orders];
        let ordersLabels = ['Commandées', 'En traitement', 'Livrées', 'Annulées'];
        let customersData = [response.confirmed_users, response.unconfirmed_users];
        let customersLabels = ['Confirmés', 'Non confirmé'];
        let incomeData = [];
        let incomeLabels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Octobre', 'Decembre'];

        response.products.forEach(function (product) {
            stockData.push(product.stock);
            stockLabels.push(product.fr_name);
        });

        response.incomes.forEach(function (income) {
            incomeData.push(income);
        });

        let stockBackgroundColors = []; let stockBorderColors = [];
        let stockHoverBackgroundColors = []; let colorIndex = 0;
        for(let i = 0; i <= stockData.length; i++)
        {
            if(COLORS.length <= colorIndex) colorIndex = 0;
            stockBackgroundColors.push(COLORS[colorIndex].background);
            stockBorderColors.push(COLORS[colorIndex].border);
            stockHoverBackgroundColors.push(COLORS[colorIndex].hover);
            colorIndex++;
        }

        let incomeChartData = {
            labels: incomeLabels,
            datasets: [{
                label: 'Montant',
                data: incomeData,
                backgroundColor: COLORS[1].background,
                borderColor: COLORS[1].border,
                hoverBackgroundColor: COLORS[1].hover,
                borderWidth: 1
            }]
        };
        let incomeChartOptions = {
            scales: {
                yAxes: [{
                    ticks: { beginAtZero: true, },
                    scaleLabel: {display: true, labelString: 'Montant (C$)'} }],
                xAxes: [{
                    ticks: { beginAtZero: true, },
                    scaleLabel: {display: true, labelString: 'Mois'} }]
            },
            responsive: true,
            legend: { display: false },
            elements: { point: { radius: 0 } }
        };

        let stockChartData = {
            labels: stockLabels,
            datasets: [{
                label: 'stock',
                data: stockData,
                backgroundColor: stockBackgroundColors,
                borderColor: stockBorderColors,
                hoverBackgroundColor: stockHoverBackgroundColors,
                borderWidth: 1
            }]
        };
        let stockChartOptions = {
            scales: {
                yAxes: [{
                    ticks: { beginAtZero: true, },
                    scaleLabel: {display: true, labelString: 'Quantité en stock'} }],
                xAxes: [{
                    ticks: { beginAtZero: true, },
                    scaleLabel: {display: true, labelString: 'Nom du produit'} }]
            },
            responsive: true,
            legend: { display: false },
            elements: { point: { radius: 0 } }
        };

        let orderChartData = {
            labels: ordersLabels,
            datasets: [{
                data: ordersData,
                backgroundColor: [
                    COLORS[1].background, COLORS[3].background,
                    COLORS[4].background, COLORS[0].background
                ],
                borderColor: [
                    COLORS[1].border, COLORS[3].border,
                    COLORS[4].border, COLORS[0].border
                ],
                hoverBackgroundColor: [
                    COLORS[1].hover, COLORS[3].hover,
                    COLORS[4].hover, COLORS[0].hover
                ],
            }]
        };
        let orderChartOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        let customerChartData = {
            labels: customersLabels,
            datasets: [{
                data: customersData,
                backgroundColor: [ COLORS[3].background,COLORS[0].background ],
                borderColor: [ COLORS[3].border,COLORS[0].border ],
                hoverBackgroundColor: [ COLORS[3].hover,COLORS[0].hover ],
            }]
        };
        let customerChartOptions = orderChartOptions;

        if ($("#incomeChart").length) {
            let incomeChartCanvas = $("#incomeChart").get(0).getContext("2d");
            new Chart(incomeChartCanvas, { type: 'line', data: incomeChartData, options: incomeChartOptions });
        }

        if ($("#stockChart").length) {
            let stockChartCanvas = $("#stockChart").get(0).getContext("2d");
            new Chart(stockChartCanvas, { type: 'bar', data: stockChartData, options: stockChartOptions });
        }

        if ($("#orderChart").length) {
            let orderChartCanvas = $("#orderChart").get(0).getContext("2d");
            new Chart(orderChartCanvas, { type: 'doughnut', data: orderChartData, options: orderChartOptions });
        }

        if ($("#customerChart").length) {
            let customerChartCanvas = $("#customerChart").get(0).getContext("2d");
            new Chart(customerChartCanvas, { type: 'pie', data: customerChartData, options: customerChartOptions });
        }
    })
    .fail(function() {
        notification('Erreur', 'Une erreur s\'est produite lors de la recupération des données',
            'danger', 'fa fa-remove', 'bounceIn', 'bounceOut', 5000);
    });
});