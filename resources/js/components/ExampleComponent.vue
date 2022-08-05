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
                        <td v-if="!item.urgent">{{ item.name }}
                            <a>
                                <button type="button" class="btn btn-outline-success"
                                    style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    move to urgent
                                </button>
                            </a>
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
                        <td v-if="item.urgent">{{ item.name }}</td>
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
                name: ""
            }
        }
    },
    mounted() {
        axios.get('/api/items')
            .then(response => (this.items = response.data));
        console.log('response')
    },
    
}
</script>
