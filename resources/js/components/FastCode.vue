<template>
    <div class="fast-codes">
        <div class="input-search-block">
            <input
                class="input"
                type="text"
                v-model="searchText"
                placeholder="Какой товар?"
            />
        </div>
        <!-- /.input-search-block -->
        <div class="mt-1 list_search">
            <h4 class="text-center" v-if="codes.length > 0">
                Пошук по: "{{ searchText }}"
                <span class="btn btn-danger btn-sm" @click="clear"
                    >Сховати</span
                >
            </h4>
            <show-all :codes="codeList" :load="load" :error="error" />
        </div>
        <!-- /.mt-1 list_search -->
    </div>
    <!-- /.fast-codes -->
</template>

<script>
import DeleteBtn from "./DeleteBtn.vue";
import ShowAll from "./ShowAll.vue";
export default {
    components: {
        DeleteBtn,
        ShowAll,
    },
    data() {
        return {
            searchText: "",
            codes: [],
            codesAll: [],
            load: false,
            error: false,
        };
    },
    watch: {
        searchText() {
            this.doInput();
        },
    },
    computed: {
        codeList() {
            if (this.searchText.length === 0) {
                return this.codesAll;
            } else {
                return this.codes;
            }
        },
    },
    methods: {
        clear() {
            this.codes = [];
            this.searchText = "";
            if (this.codesAll.length > 0) {
                this.load = true;
                this.error = false;
            }
        },
        fetchAllCodes() {
            this.load = false;
            this.error = !true;
            axios.get("/api/code/dump").then((r) => {
                if (r.status === 200) {
                    this.codesAll = r.data.data;
                    this.load = true;
                    this.error = !true;
                } else {
                    this.error = true;
                    console.error(r);
                }
            });
        },
        doInput() {
            if (this.searchText !== "") {
                this.fetchResults();
            } else {
                this.clear();
            }
        },
        fetchResults() {
            const u = `api/code/search/?s=${this.searchText}`;
            this.load = false;
            axios
                .get(u)
                .then((r) => {
                    if (r.status === 200) {
                        this.codes = r.data.data;
                        this.load = true;
                        this.error = false;
                    } else {
                        this.error = !false;
                        console.error("Помилка статуса запиту", r);
                    }
                })
                .catch((err) => {
                    console.error("Помилка запиту", err);
                });
        },
    },
    mounted() {
        this.fetchAllCodes();
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
