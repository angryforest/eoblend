@extends('layouts.guest')

@section('content')
    <div id="vueApp">

        <header id="header">
            <div class="mainContainer"
                 v-bind:style="$root.mainMenu?'display: block':''">
                <nav class="navbar navbar-expand-sm navbar-dark">
                    <a class="navbar-brand"
                       v-on:click.prevent.stop="changePage('home')"
                       href="/">
                        <img class="logo" src="/img/logo.png">
                        <span class="mainLabel">EOBlend</span>
                    </a>
                    <button class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarCollapse"
                            aria-controls="navbarCollapse"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li v-bind:class="['nav-item', {'active': currentPage=='home'}]">
                                <a href="/"
                                   class="nav-link"
                                   v-on:click.prevent.stop="changePage('home')">
                                    Калькулятор эфирных масел
                                    <span v-if="currentPage=='home'"
                                          class="sr-only">
                                        (current)
                                    </span>
                                </a>
                            </li>
                            <li v-bind:class="['nav-item', {'active': currentPage=='oilList'}]">
                                <a href="/oils"
                                   class="nav-link"
                                   v-on:click.prevent.stop="changePage('oilList', 'oils')">
                                    Справочник
                                    <span v-if="currentPage=='oilList'"
                                          class="sr-only">
                                        (current)
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <div class="mainContainer text-left">
            <div :is="currentPage">
                @include('guest.components.'.strtolower(implode('.', preg_split('/(?=[A-Z])/', $currentPage))))
            </div>
        </div>
    </div>

    <script id="homeComponent" type="text/x-template">
        @include('guest.components.home')
    </script>

    <script id="oilListComponent" type="text/x-template">
        @include('guest.components.oil.list')
    </script>

    <script id="oilItemComponent" type="text/x-template">
        @include('guest.components.oil.item')
    </script>

@endsection
