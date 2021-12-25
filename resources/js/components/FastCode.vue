<template>
    <div class="fast-codes">
        <div class="input-search-block">
            <input
                class="input"
                type="text"
                @input="doInput"
                v-model="searchText"
                placeholder="Какой товар?"
            />
        </div>
        <!-- /.input-search-block -->
        <div class="mt-1 list_search" v-if="codes.length > 0">
            <ul class="list-group">
                <li
                    class="list-group-item list-group-item-success d-flex"
                    v-for="code in codes"
                    :key="code.id"
                >
                    <span class="item text">
                        <a :href="`/code/edit/${code.id}`"> {{ code.name }} </a>
                    </span>
                    <span class="item code">
                        {{ code.code }}
                    </span>
                    <span class="item code"> (N {{ code.code_n }}) </span>
                </li>
            </ul>
            <!-- /.list-group -->
        </div>
        <!-- /.mt-1 list_search -->
    </div>
    <!-- /.fast-codes -->
</template>

<script>
export default {
    data() {
        return {
            searchText: "",
            codes: [],
        };
    },
    methods: {
        doInput() {
            this.fetchResults();
        },
        fetchResults() {
            const u = `/api/code/search/?s=${this.searchText}`;
            axios.get(u).then((response) => {
                console.log(response);
                this.codes = response.data.data;
            });
        },
    },
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

<style scoped>
.item {
    display: inline-block;
    padding: 0.7rem;
}
.text {
    font-size: 1.5rem;
    font-weight: bold;
    text-transform: uppercase;
}
a {
    text-decoration: none;
    color: inherit;
}
a:hover {
    text-decoration: none;
    color: inherit;
}
.code {
    font-size: 1.7rem;
    font-weight: bold;
    text-transform: uppercase;
}
.input {
    width: 100%;
    padding: 1.5rem;
    font-size: 1.2rem;
    font-weight: bold;
    text-transform: uppercase;
    border: 1px solid #333;
    border-radius: 15px;
    outline: none;
}
</style>
