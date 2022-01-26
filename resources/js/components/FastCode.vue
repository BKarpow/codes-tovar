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
            <h4 class="text-center">
                Пошук по: "{{ searchText }}"
                <span class="btn btn-danger btn-sm" @click="clear"
                    >Сховати</span
                >
            </h4>
            <ul class="list-group col-md-5">
                <li
                    class="list-group-item list-group-item-dark bg-dark"
                    v-for="code in codes"
                    :key="code.id"
                >
                    <span class="d-block my-1 text">
                        <a :href="`/code/edit/${code.id}`"> {{ code.name }} </a>
                    </span>
                    <span class="d-block">
                        <DeleteBtn
                            :codeId="code.id"
                            :codeName="code.name"
                            @success="fetchResults"
                        />
                    </span>
                    <!-- /.d-block -->
                    <span class="d-block">
                        <span class="item code">
                            {{ code.code }}
                        </span>
                        <span class="item code"> (N {{ code.code_n }}) </span>
                    </span>
                    <!-- /.item -->
                </li>
            </ul>
            <!-- /.list-group -->
        </div>
        <!-- /.mt-1 list_search -->
    </div>
    <!-- /.fast-codes -->
</template>

<script>
import DeleteBtn from "./DeleteBtn.vue";
export default {
    components: {
        DeleteBtn,
    },
    data() {
        return {
            searchText: "",
            codes: [],
        };
    },
    methods: {
        clear() {
            this.codes = [];
            this.searchText = "";
        },
        doInput() {
            this.fetchResults();
        },
        fetchResults() {
            const u = `api/code/search/?s=${this.searchText}`;
            axios
                .get(u)
                .then((r) => {
                    if (r.status === 200) {
                        this.codes = r.data.data;
                    } else {
                        console.error("Помилка статуса запиту", r);
                    }
                })
                .catch((err) => {
                    console.error("Помилка запиту", err);
                });
        },
    },
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

<style scoped>
li {
    border-top: 1px solid #fff;
    margin-top: 2px;
    margin-bottom: 2px;
    border-radius: 9px !important;
}
.item {
    display: inline-block;
    padding: 0.7rem;
    color: #fff;
}
.text {
    font-size: 1.2rem;
    font-weight: bold;
    text-transform: uppercase;
}
a {
    text-decoration: none;
    color: white;
}
a:hover {
    text-decoration: none;
    color: inherit;
}
.code {
    font-size: 1.3rem;
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
