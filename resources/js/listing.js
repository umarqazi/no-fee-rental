
let vue = require('vue');
let axios = require('axios');

window.onload = () => {
axios.get('/admin/listing-get').then(res => {
    console.log(res);
}).catch(err => {
    console.log(err);
});
};

vue = new Vue({
   el: '#app',
   data: {
       baths: 0,
       bedrooms: 0,
       title: '',
       thumbnail: '',
       realtyId: '',
       address: '',
       rent: 0,
       created_at: '',
   },
    computed: {

    },
    watch: {

    },
    methods: {

    },
    mount: {

    }

});
