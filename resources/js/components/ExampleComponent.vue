<template>
    <div class="container">
        <main class="container py-4">
            <table class="table table-bordered">
                <thead class="thead-inverse">
                    <tr>
                        <th>TODOS <span class="badge bg-primary rounded-pill"></span></th>
                        <th>Urgent TODOS<span class="badge bg-primary rounded-pill">14</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items">
                        <td v-if="!item.urgent">

                            <input type="checkbox" @change="updateCheck(item.id, item.completed)"
                                v-model="item.completed">
                            <span :class="[item.completed ? 'completed' : 'itemText']"> {{ item.name }}</span>

                            <button type="button" @click="updateItem(item.id, item.urgent = true)" class="btn btn-link"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                move to urgent
                            </button>

                            <button type="button" onclick="location.reload(); return false;"
                                @click="deleteItem(item.id)" class="btn btn-link"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                remove
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form>
                                <input class="form-control" type="text" placeholder="input for new TODO">
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead class="thead-inverse">
                    <tr>
                        <th>Urgent TODOS<span class="badge bg-primary rounded-pill">14</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items">
                        <td v-if="item.urgent"><input type="checkbox" @change="updateCheck(item.id, item.completed)"
                                v-model="item.completed">
                            <span :class="[item.completed ? 'completed' : 'itemText']"> {{ item.name }}</span>

                            <button type="button" @click="updateItem(item.id, item.urgent = false)" class="btn btn-link"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                move to todos
                            </button>

                            <button type="button" onclick="location.reload(); return false;"
                                @click="deleteItem(item.id)" class="btn btn-link"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                remove
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>

    </div>
</template>

<script>
export default {
    data() {
        return {
            items: {
                completed: true
            }
        }
    },
    mounted() {
        axios.get('/api/items')
            .then(response => (this.items = response.data));
        console.log('response')
    },
    methods: {
        updateCheck(id, completed) {
            console.log(id);
            const article = { completed: completed };
            axios.put('/api/item/' + id, article)
                .then(response => {
                    if (response.status == 200) {
                        console.log('response');

                    }
                })
                .catch(error => {
                    console.log(error);
                })

        },
        updateItem(id, urgent) {
            const article = { urgent: urgent };
            axios.put('/api/item/' + id, article, {
                headers: {
                    "Content-type": "application/json"
                }
            })
                .then(response => {
                    if (response.status == 200) {
                        console.log(article);
                    }
                })
                .catch(error => {
                    console.log(error);
                })

        },
        deleteItem(id) {
            axios.delete('/api/item/' + id)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('itemdeleted');
                    }
                })
                .catch(error => {
                    console.log(id);
                })
        }
    }
}
</script>

<style>
.completed {
    text-decoration: line-through;
    color: #999999
}
</style>
