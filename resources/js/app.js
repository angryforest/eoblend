var vueApp = new Vue({
    el: '#vueApp',
    data: {
        currentPage: '',
        properties: [],
        oils: [],
        oil: {},
        checkedOils: {},
        checkedProperties: {},
        disabledOils: {},
        compatibility: {},
        oilProperties: {}.
        defaultModel: {}
    },
    components: {
        home: {
            template: '#homeComponent',
            mounted: function() {
                document.title = 'Калькулятор эфирных масел | EOBlend';
            }
        },

        oilItem: {
            template: '#oilItemComponent',
            mounted: function() {
                document.title = 'Эфирное масло | EOBlend';
            }
        },

        oilList: {
            template: '#oilListComponent',
            mounted: function() {
                document.title = 'Справочник эфирных масел | EOBlend';
            }
        }
    },
    created: function() {
        this.defaultModel.oil = JSON.parse(JSON.stringify(this.oil));
    },
    methods: {

        toggleOil: function (id) {
            if(vueApp.checkedOils[id])
                delete vueApp.checkedOils[id];
            else vueApp.checkedOils[id] = true;

            var checkedCount = Object.keys(vueApp.checkedOils).length,
                enabledOils = {};

            vueApp.disabledOils = {};

            if(checkedCount) {
                vueApp.oils.forEach(function(oil) {
                    enabledOils[oil.id] = 0;
                });

                for(var oil in vueApp.checkedOils)
                    vueApp.compatibility[oil].forEach(function(pairOil) {
                        if(oil != pairOil)
                            enabledOils[pairOil]++;
                    });

                for(var oil in enabledOils)
                    if(enabledOils[oil] != checkedCount)
                        vueApp.disabledOils[oil] = true;
            }

            vueApp.$forceUpdate();
        },

        toggleProperty: function (id) {
            if(vueApp.checkedProperties[id])
                delete vueApp.checkedProperties[id];
            else vueApp.checkedProperties[id] = true;

            vueApp.$forceUpdate();
        },

        changePage: function(component, model, id) {
            var path = '';

            if(model) {
                path = model;
                if(id) path = path + '/' + id;

                switch(model) {
                    case 'oil':
                        vueApp.oil = JSON.parse(JSON.stringify(vueApp.defaultModel.oil));
                        if(id) vueApp.getModel(model, path);
                        break;
                    default:
                        //vueApp.getModel(model, path);
                        break;
                }
            }
            else {
                if(component == 'home') path = '';
                else path = component;
            }

            vueApp.currentPage = component;
            vueApp.mainMenu = false;
            window.history.pushState('', '', '/' + path);
            $('.navbar-collapse').collapse('hide');
        },

        getModel: function(model, path) {
            axios.get('/json/' + path)
                .then(function(response) {
                    if(response.data) {
                        switch(model) {
                            default:
                                vueApp[model] = response.data;
                                break;
                        }
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
});

