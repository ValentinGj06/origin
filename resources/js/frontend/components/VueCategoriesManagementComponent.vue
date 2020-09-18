<template>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped table-borderless table-info table-hover">
                <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                    <td v-if="!category.editing"
                        @dblclick="enableEditingCategory(category.name, category.editing = true)"
                        v-model="category.name">{{ category.name }}
                    </td>
                    <div class="input-group" v-if="category.editing">
                        <input v-focus v-click-outside="disableEditingCategory" v-model="tempValue" type="text"
                               class="form-control"
                               placeholder="Category" aria-label="Category"
                               aria-describedby="basic-addon2"/>
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="button"
                                    @click="disableEditingCategory(null,category.editing = false)"> Cancel
                            </button>
                            <button class="btn btn-outline-dark" type="button"
                                    @click="saveEditCategory(category.id, category.name = tempValue, category.editing = false)">
                                Save
                            </button>
                        </div>
                    </div>
                    <td v-if="!category.editing">
                        <button type="button" class="close" aria-label="Close"
                                @click="deleteCategory(index, category.id)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="col-md-6">
            <div class="input-group">
                <input autocomplete="off" type="text" id="category" v-model="category" class="form-control" placeholder="Category e.g. football player">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" @click.prevent="createCategory" :disabled="category.length == 0">Add Category</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.directive('click-outside', {
        bind: function (el, binding, vnode) {
            window.event = function (event) {
                if (!(el == event.target || el.contains(event.target))) {
                    vnode.context[binding.expression](event);
                }
            };
            document.body.addEventListener('click', window.event)
        },
        unbind: function (el) {
            document.body.removeEventListener('click', window.event)
        },
    });
    export default {

        props: [],
        data() {
            return {
                categories: {},
                category: '',
            }
        },
        directives: {
            focus: {
                // directive definition
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        methods: {
            displayCategories() {
                axios.get('api/categories').then(({data}) => {
                    $.each(data, function (key, value) {
                        value.editing = false;
                    });
                    this.categories = data;
                });
            },

            createCategory() {
                axios.post('api/categories', {
                category: this.category
                .replace(/\s/g, "_").toLowerCase()
                })
                .then(({data}) => {
                    console.log(data);
                    this.categories = [...this.categories, data.response_categories];
                });
            },

            enableEditingCategory(category, editable) {
                this.tempValue = category;
            },
            disableEditingCategory: function (category, editable) {
                this.tempValue = null;
                $.each(this.categories, function (key, value, row) {
                    value.editing = false;
                });
            },
            saveEditCategory: function (id, category) {
                this.value = this.tempValue;
                axios.patch('api/update/categories', {id: id, category: this.value}).then(({data}) => {
                });
            },
            deleteCategory: function(index, id) {
                this.showMsgConfirm(index, id);
            },
            showMsgConfirm(index, id) {
                this.$bvModal.msgBoxConfirm('Please confirm that you want to delete.', {
                    title: 'Please Confirm',
                    size: 'md',
                    buttonSize: 'md',
                    okVariant: 'danger',
                    okTitle: 'YES',
                    cancelTitle: 'NO',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {
                        if(value){
                            this.categories.splice(index, 1);
                            axios.delete('api/categories/'+id)
                                    .then(({data}) => {
                                        toastr["success"]('Category ' +data.deleted_category+ ' has been deleted.', "Success");
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                        } else {
                            return false;
                        }
                    })
                    .catch(err => {
                        // An error occurred
                    })
            }
        },
        created() {
            this.displayCategories();
        }
    }

</script>
