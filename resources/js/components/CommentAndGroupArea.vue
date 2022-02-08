<template>
    <div class="f">
        <label for="comment">Категорія товару</label>
        <ul>
            <li
                v-for="(group, index) in groups"
                :key="index"
                @click="onSelect(group.comment)"
            >
                {{ group.comment }}({{ group.count }})
            </li>
        </ul>

        <input
            type="text"
            class="form-control"
            name="comment"
            v-model="valueGroup"
            maxlength="50"
            required
            placeholder="Виберіть категорію, або створіть нову"
        />
    </div>
    <!-- /.form-group -->
</template>

<script>
export default {
    props: {
        groupValue: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            valueGroup: "",
            groups: [],
        };
    },

    methods: {
        onSelect(groupName) {
            this.valueGroup = groupName;
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
    },
    mounted() {
        this.fetchGroups();
        if (this.groupValue !== "") {
            this.valueGroup = this.groupValue;
        }
    },
};
</script>

<style scoped>
ul {
    padding: 0;
    margin-bottom: 0.7rem;
    list-style: none;
    display: flex;
    flex-wrap: wrap;
}

li {
    display: block;
    margin-right: 0.7rem;
    margin-top: 0.4rem;
    padding: 0.3rem;
    border: 1px solid #333;
    border-radius: 10px;
    cursor: pointer;
    background: #333;
    color: white;
    transition: all 0.6s;
}

li:hover {
    background: #111;
}
</style>
