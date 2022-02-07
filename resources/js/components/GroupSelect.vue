<template>
    <div class="my-1">
        <ul class="list-group">
            <li
                class="list-group-item list-group-item-dark"
                v-for="(group, index) in groups"
                :key="index"
                @click="onClick(group.comment)"
            >
                {{ group.comment }}({{ group.count }})
            </li>
            <!-- /.list-group-item -->
        </ul>
    </div>
    <!-- /.my-1 -->
</template>

<script>
export default {
    name: "GroupSelect",
    props: {
        groups: {
            type: Array,
            require: true,
        },
    },
    methods: {
        onClick(groupName) {
            console.log("Click to group: ", groupName);
            this.$emit("click:group", groupName);
        },
    },
};
</script>

<style scoped>
li {
    cursor: pointer;
    transition: all 0.6s;
    background: #333;
    color: white;
    font-size: 2rem;
}
li:hover {
    background: #111;
    color: white;
    font-size: 3rem;
}
</style>
