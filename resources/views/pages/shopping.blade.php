@extends('layouts.app')

@section('title')
    Smartkoli - Bevásárlólista
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{url('/css/shopping.css')}}">
@endsection

@section('content')

    <div id="shopping-app">
        <div class="row">
            <article class="col-md-8 mb-2">
                <div class="card">
                    <!--<h5 class="card-header">Bevásárlólista</h5>-->
                    <div class="card-body">
                        <div class="list-group">

                            <shopping-item v-for="item in items" :name="item.name" :key="item.id"></shopping-item>

                            <div class="list-group-item">
                                <form @submit.prevent="addNewItem" id="add-new-item-form">
                                    <div class="input-group">
                                        <input type="text" v-model="newItem" class="form-control" placeholder="Írd ide, amire szüksége van a kolinak...">
                                        <button id="add-new-item-button" type="submit" class="btn btn-primary ml-2">+</button>
                                    </div>
                                </form>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </article>

            <article class="col-md-4 mb-2">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Hogyan használd?</h4>
                    <p class="howto-text">Ha azt érzékeled, hogy valami olyan hiányzik a kollégiumból, amit a beszerzők dolga lenne megvenni, kérjük írd fel a listára.</p>
                    <hr>
                    <p class="howto-text">Ha ebben a hónapban te vagy a beszerző, köteles vagy az itt felírt dolgokat a lehető leghamarabb beszerezni, majd a listáról kihúzni. Köszönjük!</p>
                </div>
            </article>
        </div>
    </div>

@endsection

@section('scripts-body')
    <script>
        $(document).ready( function() {
            $('#nav-shopping').css('font-weight','bold');
        });
    </script>

    <script>
        Vue.component('shopping-item', {
            delimiters: ['[[', ']]'],
            props: ['name'],
            template: `
                <div class="list-group-item">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" :checked="isPurchased" :disabled="isDisabled" :id="this.$vnode.key" @click="changeStatus">
                        <label :for="this.$vnode.key" class="form-check-label ml-2" :class="{ 'item-purchased': isPurchased }">[[ name ]]</label>
                    </div>
                    <small v-if="isPurchased" class="text-muted">Az oldal újrarissítéséig visszavonhatod a kihúzást.</small>
                </div>
            `,  

            data() {
                return {
                    isPurchased: false,
                    isDisabled: false
                }
            },

            methods: {
                
                changeStatus() {

                    let vm = this;

                    vm.isDisabled = true;

                    axios.patch('/shopping/items/edit/' + vm.$vnode.key)
                        .then(() => {
                            vm.isDisabled = false;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    this.isPurchased = !this.isPurchased;
                    
                }
            }          
        });

        new Vue({

            delimiters: ['[[', ']]'],
            el: '#shopping-app',
            data: {
                text: 'Vue works!',
                items: [],
                newItem: null,
            },

            methods: {

                fetchItems() {

                    let vm = this;

                    vm.items = [];

                    axios.get('/shopping/items')
                        .then(function (response) {

                            response.data.forEach(item => {

                                if(!item.is_purchased) {
                                    vm.items.push(item);
                                }
                            });
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },

                addNewItem() {

                    let vm = this;

                    axios.post('/shopping/items/new', {
                        "name": vm.newItem,
                    })
                    .then((response) => {
                        vm.items.push({
                            "id": response.data.new_item_id,
                            "name": vm.newItem,
                            "user_id": response.data.user_id,
                            "is_purchased": false,
                        });
                        vm.newItem = null;
                        console.log("Refetched items");
                    })
                    .catch((error) => {
                        console.log("Error while adding new comment: " + error);
                    });
                }

            },

            created() {

                this.fetchItems();

            }
        });
    </script>
@endsection

<!-- FOOTER ------------->
@section('footer')
    @include('layouts.footer')
@endsection
<!-- END OF FOOTER ------>