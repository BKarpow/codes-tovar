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
        <div class="my-2 d-flex justify-content-center">
            <button
                type="button"
                @click="groupSelector = !groupSelector"
                class="btn d-block"
                :class="{
                    'btn-danger': groupSelector,
                    'btn-success': !groupSelector,
                }"
            >
                {{ btnTextGroupSelector }}
            </button>
        </div>
        <div class="my-1" v-if="groupSelector">
            <GroupSelect
                :groups="groups"
                @click:group="getCodesFromGroupName"
            />
            <div class="mt-2 mb-3" v-if="codesOfGroup.length > 0">
                <h2 class="text-center">{{ groupName }}</h2>
                <show-all
                    :codes="codesOfGroup"
                    :load="load"
                    :error="error"
                    @deleted="fetchAllCodes"
                />
            </div>
            <!-- /.my-1 -->
        </div>
        <!-- /.my-1 -->
        <div class="mt-1 list_search">
            <h4 class="text-center" v-if="codes.length > 0">
                Пошук по: "{{ searchText }}"
                <span class="btn btn-danger btn-sm" @click="clear"
                    >Сховати</span
                >
            </h4>
            <show-all
                :codes="codeList"
                :load="load"
                :error="error"
                @deleted="fetchAllCodes"
            />
        </div>
        <!-- /.mt-1 list_search -->
    </div>
    <!-- /.fast-codes -->
</template>

<script>
import DeleteBtn from "./DeleteBtn.vue";
import ShowAll from "./ShowAll.vue";
import GroupSelect from "./GroupSelect.vue";
export default {
    components: {
        DeleteBtn,
        ShowAll,
        GroupSelect,
    },
    data() {
        return {
            searchText: "",
            codes: [],
            codesAll: [],
            load: false,
            error: false,
            groups: [],
            codesOfGroup: [],
            groupName: "",
            groupSelector: false,
        };
    },
    watch: {
        searchText() {
            this.doInput();
        },
    },
    computed: {
        btnTextGroupSelector() {
            return this.groupSelector
                ? "Закрити вибір через групу"
                : "Групи кодів";
        },
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
        fetchGroups() {
            axios.get("/api/code/group").then((r) => {
                if (r.status === 200) {
                    this.groups = r.data.data;
                } else {
                    console.error("Error fetching groups list!");
                }
            });
        },
        getCodesFromGroupName(groupName) {
            axios.post("/api/code/from", { group: groupName }).then((r) => {
                if (r.status === 200) {
                    this.codesOfGroup = r.data.data;
                    this.groupName = groupName;
                } else {
                    console.error(
                        "Error getting codes of group name: ",
                        groupName
                    );
                }
            });
        },
    },
    mounted() {
        this.fetchAllCodes();
        this.fetchGroups();
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
