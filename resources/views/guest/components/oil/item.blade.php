<article id="catalog" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="{{ (@$oil)?$oil->id:0 }} == $root.oil.id" class="panel panel-default">
                        <div class="panel-heading mbot3">
                            <h1>{{ @$oil->title }}</h1>
                        </div>
                        <div class="panel-body oil-description">
                            <p><img src="{{ @$oil->cover }}" alt="" class="img-rounded"></p>
                            <p>{{ @$oil->plant }}</p>
                            <p>{{ @$oil->aroma }}</p>
                            <p>{{ @$oil->properties }}</p>
                            <p>{{ @$oil->methods }}</p>
                            <p>{{ @$oil->contraindications }}</p>
                        </div>
                    </div>
                    <div v-else class="panel panel-default">
                        <div class="panel-heading mbot3">
                            <h1>@{{ $root.oil.title }}</h1>
                        </div>
                        <div class="panel-body oil-description">
                            <p><img v-bind:src="$root.oil.cover" alt="" class="img-rounded"></p>
                            <p>@{{ $root.oil.plant }}</p>
                            <p>@{{ $root.oil.aroma }}</p>
                            <p>@{{ $root.oil.properties }}</p>
                            <p>@{{ $root.oil.methods }}</p>
                            <p>@{{ $root.oil.contraindications }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>