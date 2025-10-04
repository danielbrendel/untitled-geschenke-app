/**
 * app.js
 * 
 * Put here your application specific JavaScript implementations
 */

import './../sass/app.scss';

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.spawnVueInstance = function(el) {
    return new Vue({
        el: el,

        data: {
            bShowAddPerson: false,
        },

        methods: {
            initNavbar: function() {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                if ($navbarBurgers.length > 0) {
                    $navbarBurgers.forEach( el => {
                        el.addEventListener('click', () => {
                            const target = el.dataset.target;
                            const $target = document.getElementById(target);

                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');
                        });
                    });
                }
            },

            ajaxRequest: function (method, url, data = {}, successfunc = function(data){}, finalfunc = function(){}, config = {})
            {
                let func = window.axios.get;
                if (method == 'post') {
                    func = window.axios.post;
                } else if (method == 'patch') {
                    func = window.axios.patch;
                } else if (method == 'delete') {
                    func = window.axios.delete;
                }

                func(url, data, config)
                    .then(function(response){
                        successfunc(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .finally(function(){
                            finalfunc();
                        }
                    );
            },
        }
    });
};

document.addEventListener('DOMContentLoaded', function() {
    window.vue = window.spawnVueInstance('#app');

    window.vue.initNavbar();
})