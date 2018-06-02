//--Min max script
$(function () {
    //--Max ramaining character display
    $('.min_max').maxlength({
        alwaysShow: true,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger",
        placement: 'top'
    });
});

//--Form inputs validation
new Vue({
    el: '.form-validation',
    data: {},
    methods: {
        validateElement: function (event) {
            var element = event.target;
            if(element.tagName === 'FORM')
            {
                if(!isFormValidation(element))
                    event.preventDefault();
            }
            else
            {
                validation(element) ?
                    setValidIndicator(element) :
                    setInvalidIndicator(element);
            }
        }
    }
});

function setValidIndicator(element){
    element.classList.remove('form-invalid');
    element.classList.add('form-valid');
}

function setInvalidIndicator(element){
    element.classList.remove('form-valid');
    element.classList.add('form-invalid');
}

function validation(element){
    var isValid = true;

    if(element.tagName === 'INPUT')
    {
        var type = element.type;
        var value = element.value;

        if(type === 'email')
        {
            var match = value.match(/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i);
            isValid = match && isMinMaxValidation(element);
        }
        else if(type === 'number')
        {
            isValid = isIntegerValidation(element) && isMinMaxValidation(element);
        }
        else if(type === 'password')
        {
            if(element.name === 'password_confirmation')
            {
                var password = document.getElementById('password');
                isValid = value === password.value && isMinMaxValidation(element);
            }
            else isValid = isMinMaxValidation(element);
        }
        else if(type === 'text') isValid = isMinMaxValidation(element);
    }
    else if(element.tagName === 'TEXTAREA')
    {
        isValid = isMinMaxValidation(element);
    }
    else if(element.tagName === 'SELECT')
    {
        isValid = isIntegerValidation(element);
    }

    return isValid;
}

function isMinMaxValidation(element){
    var length = element.value.length;
    var minLength = element.minLength;
    var maxLength = element.maxLength;

    return !(length < minLength || length > maxLength);
}

function isIntegerValidation(element){
    return !(!element.value.match(/^[0-9]+$/));
}

function isFormValidation(element){
    var isValid = true;

    for(var i = 0; i < element.length; i++)
    {
        if(!(element[i].type === 'hidden') && !(element[i].type === 'submit'))
        {
            if(validation(element[i])) setValidIndicator(element[i]);
            else
            {
                isValid = false;
                setInvalidIndicator(element[i]);
            }
        }
    }

    return isValid;
}