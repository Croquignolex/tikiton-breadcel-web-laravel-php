//--Elements per pages product filter redirection
new Vue({
    el: '.products_per_page',
    data: {},
    methods: {
        filter: function (event) {
            let value = event.target.value;

            window.location.href = routeQueryParameterExist('products_per_page') ?
                updateRouteQueryParameter('products_per_page', value) :
                addRouteQueryParameter('products_per_page', value);
        }
    },
});

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