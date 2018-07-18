new Vue({
    el: '#app',
    data: {},
    methods: {
        validateFormElements: function (event) {
            let element = event.target;
            if(element.tagName === 'FORM')
            {
                if(!isFormValidation(element))
                    event.preventDefault();
            }
        },
        validateFormElement: function (event) {
            let element = event.target;
            let elementDataSet = element.dataset;
            if(element.tagName !== 'FORM' && elementDataSet.validate === 'true')
            {
                validation(element) ?
                    setValidIndicator(element) :
                    setInvalidIndicator(element);
            }
        }
    }
});