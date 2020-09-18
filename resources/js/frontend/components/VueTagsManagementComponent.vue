<template>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped table-borderless table-info table-hover">
            <tbody>
            <tr v-for="(tag, index) in tags" :key="tag.id">
                <td v-if="!tag.editing" @dblclick="enableEditingTag(tag.name, tag.editing = true)"
                v-model="tag.name">{{ tag.name }}
                </td>
                <div class="input-group" v-if="tag.editing">
                    <input v-focus v-click-outside="disableEditingTag" v-model="tempValue" type="text"
                           class="form-control"
                           placeholder="Tag" aria-label="Tag"
                           aria-describedby="basic-addon2"/>
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" type="button"
                                @click="disableEditingTag(null,tag.editing = false)"> Cancel
                        </button>
                        <button class="btn btn-outline-dark" type="button"
                                @click="saveEditTag(tag.id, tag.name = tempValue, tag.editing = false)"> Save
                        </button>
                    </div>
                </div>
                <td v-if="!tag.editing">
                    <button type="button" class="close" aria-label="Close"
                            @click="deleteTag(index, tag.id)">
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
                <input autocomplete="off" type="text" id="tag" v-model="tag" class="form-control" placeholder="Tag e.g. esport">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" @click.prevent="createTag" :disabled="tag.length == 0">Add Tag</button>
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
        directives: {
            focus: {
                // directive definition
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        data() {
            return {
                tempValue: null,
                tags: {},
                tag: '',
            }
        },
        methods: {
            displayTags() {
                axios.get('api/tags').then(({data}) => {
                    $.each(data, function (key, value, row) {
                        value.editing = false;
                    });
                    this.tags = data;
                });
            },

            createTag() {
                axios.post('api/tags', {
                tag: this.tag
                .replace(/\s/g, "_").toLowerCase()
                })
                .then(({data}) => {
                    this.tags = [...this.tags, data.response_tags];
                });
            },
            enableEditingTag(tag, editable) {
                this.tempValue = tag;
            },
            disableEditingTag: function (tag, editable) {
                this.tempValue = null;
                $.each(this.tags, function (key, value, row) {
                    value.editing = false;
                });
            },
            saveEditTag: function (id, tag) {
                this.value = this.tempValue;
                axios.patch('api/update/tags', {id: id, tag: this.value}).then(({data}) => {
                });
            },
            deleteTag: function(index, id) {
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
                            this.tags.splice(index, 1);
                            axios.delete('api/tags/'+id)
                                    .then(({data}) => {
                                        toastr["success"]('Tag ' +data.deleted_tag+ ' has been deleted.', "Success");
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
            this.displayTags();
        }
    }

</script>
