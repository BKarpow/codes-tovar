<template>
    <a class="btn btn-danger btn-sm" @click="doDelete">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-trash-fill"
            viewBox="0 0 16 16"
        >
            <path
                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
            />
        </svg>
    </a>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "DeleteBtn",
    props: {
        codeName: {
            type: String,
            default: "no name",
        },
        codeId: {
            type: Number,
            require: true,
        },
    },
    methods: {
        doDelete() {
            Swal.fire({
                title: `Удалить этот '${this.codeName}' код?`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Удалить",
                denyButtonText: "Нет",
                customClass: {
                    actions: "my-actions",
                    cancelButton: "order-1 right-gap",
                    confirmButton: "order-2",
                    denyButton: "order-3",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Удалено!", "", "success");
                    this.onDelete();
                } else if (result.isDenied) {
                    Swal.fire("Удаления отменено!", "", "info");
                }
            });
        },
        onDelete() {
            const urlDelete = "/code/destroy/" + this.codeId;
            axios
                .delete(urlDelete)
                .then((r) => {
                    if (r.status === 200) {
                        this.$emit("success", { delete: true });
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
