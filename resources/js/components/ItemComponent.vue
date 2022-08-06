<template>
    <div class="addItem">

        <form>
            <input v-model="item.name" type="text" class="form-control" placeholder="input for new TODO">
            <div v-if="item.name" >
                <button class="btn btn-outline-secondary btn-sm" @click="addItem()" type="submit"
                id="button-addon2">Add</button>
            </div>
        </form>

    </div>

</template>

<script>
export default {
    data: function () {
        return {
            item: {
                name: ""
            }
        }
    },
    methods: {
        addItem() {
            axios.post('/api/item/store', this.item, {
                headers: {
                    "Content-type": "application/json"
                }
            })
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>

<style>

.form-control {
    height: 1.7rem;
}
</style>