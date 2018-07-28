function manageFilter(parameter, value) {
    window.location.href = routeQueryParameterExist(parameter) ?
        updateRouteQueryParameter(parameter, value) :
        addRouteQueryParameter(parameter, value);
}

function addRouteQueryParameter(parameter, value) {
    let queryString = getQueryString();

    let updatedQueryString = (queryString === null) ?
        parameter + '=' + value :
        queryString + '&' + parameter + '=' + value;

    return getBaseUrl() + '?' + updatedQueryString;
}

function updateRouteQueryParameter(parameter, value) {
    let updatedQueryString = [];
    let queryString = getQueryString().split('&');

    queryString.forEach(function (parameterAndValue) {
        let temp = parameterAndValue.split('=');
        if(temp.length >= 2) {
            if(temp[0] === parameter) temp[1] = value;
        }
        else if(temp.length === 1) {
            if(temp[0] === parameter) temp.push(value);
        }
        updatedQueryString.push(temp.join('='));
    });

    return getBaseUrl() + '?' + updatedQueryString.join('&');
}

function getBaseUrl() {
    let uri = window.location.href.split('?');
    return (uri.length >= 1) ? uri[0] : null;
}

function getQueryString() {
    let uri = window.location.href.split('?');
    return (uri.length >= 2) ? uri[1] : null;
}

function routeQueryParameterExist(parameter) {
    let queryString = getQueryString();
    let parameterExist = false;

    if(queryString !== null) {
        queryString = queryString.split('&');
        if(queryString.length >= 1) {
            queryString.forEach(function (parameterAndValue) {
                let temp = parameterAndValue.split('=');
                if(temp.length >= 2) {
                    if(temp[0] === parameter) parameterExist = true;
                }
                else if(temp.length === 1) {
                    if(temp[0] === parameter) parameterExist = true;
                }
            });
        }
    }

    return parameterExist;
}

(function ($) {
    "use strict";
    $(document).ready(function($){
        //prise slider
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [$("#price-amount").attr('min'), $("#price-amount").attr('max')],
            slide: function(event, ui) {
                $("#price-amount").val("C$" + ui.values[0] + " - C$" + ui.values[1]);
            }
        });
        $("#price-amount").val("C$" + $("#slider-range").slider("values", 0 ) +
            " - C$" + $("#slider-range").slider("values", 1));

        $("#slider-range").on('mouseup', function () {
           let minMaxTabWithCurrency = $("#price-amount").val().split(' - ');
           if(minMaxTabWithCurrency.length >= 2)
           {
               let minTabWithoutCurrency = minMaxTabWithCurrency[0].split('C$');
               let maxTabWithoutCurrency = minMaxTabWithCurrency[1].split('C$');
               let min = minTabWithoutCurrency[1];
               let max = maxTabWithoutCurrency[1];
               manageFilter('min-max-price', min + '-' + max);
           }
        });
    });
})(jQuery);