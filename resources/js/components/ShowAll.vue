<template>
    <div class="code-list">
        <div v-if="!load" class="spinner-border m-5" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div v-if="error" class="alert alert-warning">
            <strong>Помилка завантаження списку кодів</strong>
        </div>
        <!-- /.alert alert-warning -->
        <div v-if="load">
            <ol>
                <li v-for="code in codes" :key="code.id">
                    <a :href="`/code/edit/${code.id}`"> {{ code.name }} </a> -
                    <span class="c"> {{ code.code }} </span>
                    <span v-if="code.code_n != 0" class="n">{{
                        code.code_n
                    }}</span>
                    <span class="i">
                        <delete-btn :codeId="code.id" :codeName="code.name" />
                    </span>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.code-list -->
</template>

<script>
import DeleteBtn from "./DeleteBtn.vue";

export default {
    name: "ShowAll",
    components: {
        DeleteBtn,
    },
    props: {
        codes: {
            type: Array,
            default: [],
        },
        load: {
            type: Boolean,
            default: false,
        },
        error: {
            type: Boolean,
            default: false,
        },
    },
};
</script>

<style scoped>
ol {
    list-style: none;
    padding: 0.7rem;
    margin: 0;
    background: #383838;
    color: #fdfdfd;
    border-radius: 12px;
}

i {
    display: inline-block !important;
}
li {
    text-transform: uppercase;
    font-size: 1.1rem;
    margin-top: 0.7rem;
    margin-bottom: 0.7rem;
    padding-top: 0.7rem;
    padding-bottom: 0.7rem;
    border-bottom: 1px solid #fdfdfd;
}

a {
    text-decoration: none;
    color: inherit;
}
a:hover {
    text-decoration: none;
    color: inherit;
}
.n {
    font-weight: bold;
}

.n::before {
    content: " - (N";
}
.n::after {
    content: ")";
}
</style>
