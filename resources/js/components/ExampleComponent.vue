<template>
    <div class="container">
        <main class="container py-4">

            <div class="todos">
                <table class="table table-bordered table-hover">
                    <thead class="thead-inverse">
                        <tr>
                            <th>TODOS <span class="badge bg-primary rounded-pill">{{ this.count.todos }}</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items">
                            <td v-if="!item.urgent" class="hover-effect-btn">
                                <div class="overlay">
                                    <input type="checkbox" @change="updateCheck(item.id, item.completed)"
                                        v-model="item.completed" @click="itenCounts">
                                    <span :class="[item.completed ? 'completed' : 'itemText']"> {{ item.name }}</span>
                                </div>

                                <div class="button">
                                    <button type="button" @click="updateItem(item.id, item.urgent = true)"
                                         class="btn btn-link"
                                         onclick="location.reload(); return false;"
                                        style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">move
                                        to urgent </button>
                                    <button type="button" 
                                        @click="deleteItem(item.id, item.urgent = true)" class="btn btn-link"
                                        onclick="location.reload(); return false;"
                                        style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" > remove </button>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <item-component></item-component>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="urgent todos">
                <table class="table table-bordered table-hover">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Urgent TODOS
                                <span
                                    :class="[this.count.urgent_todos < 4 ? 'badge bg-primary rounded-pill' : 'badge bg-primary rounded-pill bg-danger']">{{
                                            this.count.urgent_todos
                                    }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items">
                            <td v-if="item.urgent" class="hover-effect-btn">
                                <div class="overlay">
                                    <input type="checkbox" @change="updateCheck(item.id, item.completed)"
                                        v-model="item.completed">
                                    <span :class="[item.completed ? 'completed' : 'itemText']">{{ item.name }}</span>
                                </div>

                                <div class="button">
                                    <button type="button" @click="updateItem(item.id, item.urgent = false)"
                                         class="btn btn-link"
                                         onclick="location.reload(); return false;"
                                        style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">move
                                        to todos</button>
                                    <button type="button" 
                                        @click="deleteItem(item.id, item.urgent = false)" class="btn btn-link"
                                        onclick="location.reload(); return false;"
                                        style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">remove</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>

    </div>
</template>

<script>


export default {
    props: [
        'count'
    ],
    data() {
        return {
            items: {
                name: ""
            },
        }
    },
    mounted() {
        axios.get('/api/items')
            .then(response => (this.items = response.data));
        console.log('response');
    },
    methods: {
        updateCheck(id, completed) {
            console.log(id);
            const article = { completed: completed };
            axios.put('/api/item/' + id, article)
                .then(response => {
                    if (response.status == 200) {
                        console.log('update');
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
                    if (response.status == 200 && urgent == false) {
                        this.count.todos = this.count.todos + 1;
                        this.count.urgent_todos = this.count.urgent_todos - 1;
                        console.log(article);
                        console.log('todos :');
                        console.log(this.count.todos);
                    }
                    if (response.status == 200 && urgent == true) {
                        this.count.todos = this.count.todos - 1;
                        this.count.urgent_todos = this.count.urgent_todos + 1;
                        console.log(article);
                        console.log('urgent todos :');
                        console.log(this.count.urgent_todos);
                    }   
                })
                .catch(error => {
                    console.log(error);
                })

        },
        deleteItem(id, urgent) {
            axios.delete('/api/item/' + id)
                .then(response => {
                     if (response.status == 200 && urgent == false) {
                        this.count.urgent_todos = this.count.urgent_todos - 1;
                        console.log(this.count.urgent_todos);
                    }
                    if (response.status == 200 && urgent == true) {
                        this.count.todos = this.count.todos - 1;
                        console.log(this.count.todos);
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

.overlay {
    float: left;
}

.button {
    text-align: center;
    opacity: 0;
    float: right;
}

.button a {
    background: #ff921e;
    /* Цвет кнопки */
    color: white;
    /* Цвет текста */
}

.hover-effect-btn:hover .button {
    opacity: 1;
}

.todos {
    float: left;
}

.urgent todos {
    float: right;
}
</style>
