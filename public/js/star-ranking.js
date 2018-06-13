Vue.component('star-ranking', {

    template:   '<p>' +
                    '<i class="on fa" v-for="rating in ratings" @click="set(rating)" @mouseover="hover(rating)" @mouseout="out"' +
                    ' :class="{ \'fa-star-o\': (value < rating), \'fa-star\': (value >= rating) }"' +
                    ' :title="rating + \'/5\'" data-toggle="tooltip" data-placement="bottom"></i>' +
                    '<input type="hidden" :value="selectedValue" name="ranking">' +
                '</p>',

    /*
     * Initial state of the component's data.
     */
    data: function() {
        return {
            selectedValue : 0,
            value: 0,
            ratings: [1, 2, 3, 4, 5]
        };
    },

    methods: {
        /*
         * Behaviour of the stars on mouse over.
         */
        hover: function(_rating) {
            this.value = _rating;
        },

        /*
         * Behaviour of the stars on mouse out.
         */
        out: function() {
           this.value = this.selectedValue;
        },

        /*
         * Behaviour of the stars on click.
         */
        set: function(_rating) {
           this.value = _rating;
           this.selectedValue = _rating;
        }
    }
});

new Vue({
    el: '#user-rate'
});