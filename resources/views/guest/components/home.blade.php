<article class="container-fluid">
    <div class="row mbot3">
        <div class="col-md-12">
            <h1>Создайте гармоничную аромакомпозицию с помощью калькулятора эфирных масел</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4 mbot3">
            Для составления аромaсмеси выберите поочерёдно интересующие вас масла, калькулятор выделит благоприятные сочетания.
        </div>
        <div class="col-sm-6 col-md-4 mbot3">
            Легкие масла испаряются быстрее, и композиция со временем меняет свой аромат. Стоит добавить хотя бы по одному маслу от каждого класса летучести.
        </div>
        <div class="col-sm-6 col-md-4 mbot3">
            Выберите необходимые свойства масел для изготовления косметических средств. Помните, что масла могут вызывать сильную аллергию.
        </div>
    </div>
    <div class="row mbot2">
        <div class="col-sm-12">
            <span v-for="property in $root.properties"
                  @click="$root.toggleProperty(property.id)"
                  v-bind:title="property.rus_description"
                  v-bind:class="['oilButton', {'active': $root.checkedProperties[property.id]}]">
                @{{ property.rus_name }}
                <sup class="propertySup" v-if="$root.checkedProperties[property.id]">@{{ property.id }}</sup>
            </span>
        </div>
    </div>
    <div class="row mbot2">
        <div class="mbot2 col-sm-6 col-md-4">
            <div class="highVolatility">
                <div class="volatilityTitle">
                    <h2>Лёгкие масла <small>верхня нота</small></h2>
                </div>
                <div class="volatilityOils">
                    <span v-for="item in $root.oils"
                          v-if="item.volatility < 2"
                          @click="$root.toggleOil(item.id)"
                          v-bind:class="['oilButton',
                          {'active': $root.checkedOils[item.id]},
                          {'disabled': $root.disabledOils[item.id] && !$root.checkedOils[item.id]},
                          {'available': Object.keys($root.checkedOils).length && !$root.disabledOils[item.id] && !$root.checkedOils[item.id]}]">
                        @{{ item.rus_name }}
                        <span class="property">
                            <template v-for="(property, i) in $root.properties"
                                      v-if="$root.checkedProperties[property.id] && $root.oilProperties[item.id] && $root.oilProperties[item.id][property.id]">
                                <span>@{{ property.id }}</span><span class="op05">, </span>
                            </template>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="mbot2 col-sm-6 col-md-4">
            <div class="averageVolatility">
                <div class="volatilityTitle">
                    <h2>Средние масла <small>средняя нота</small></h2>
                </div>
                <div class="volatilityOils">
                    <span v-for="item in $root.oils"
                          v-if="item.volatility > 1 && item.volatility < 3"
                          @click="$root.toggleOil(item.id)"
                          v-bind:class="['oilButton',
                          {'active': $root.checkedOils[item.id]},
                          {'disabled': $root.disabledOils[item.id] && !$root.checkedOils[item.id]},
                          {'available': Object.keys($root.checkedOils).length && !$root.disabledOils[item.id] && !$root.checkedOils[item.id]}]">
                        @{{ item.rus_name }}
                        <span class="property">
                            <template v-for="(property, i) in $root.properties"
                                      v-if="$root.checkedProperties[property.id] && $root.oilProperties[item.id] && $root.oilProperties[item.id][property.id]">
                                <span>@{{ property.id }}</span><span class="op05">, </span>
                            </template>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="mbot2 col-sm-6 col-md-4">
            <div class="lowVolatility">
                <div class="volatilityTitle">
                    <h2>Тяжёлые масла <small>нижняя нота</small></h2>
                </div>
                <div class="volatilityOils">
                    <span v-for="item in $root.oils"
                          v-if="item.volatility > 2"
                          @click="$root.toggleOil(item.id)"
                          v-bind:class="['oilButton',
                          {'active': $root.checkedOils[item.id]},
                          {'disabled': $root.disabledOils[item.id] && !$root.checkedOils[item.id]},
                          {'available': Object.keys($root.checkedOils).length && !$root.disabledOils[item.id] && !$root.checkedOils[item.id]}]">
                        @{{ item.rus_name }}
                        <span class="property">
                            <template v-for="(property, i) in $root.properties"
                                      v-if="$root.checkedProperties[property.id] && $root.oilProperties[item.id] && $root.oilProperties[item.id][property.id]">
                                <span>@{{ property.id }}</span><span class="op05">, </span>
                            </template>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</article>