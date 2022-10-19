<template>
    <transition>
        <div class="vue-modal-backdrop" v-show="show" @click.stop.prevent="dismiss">
            <div class="vue-modal">
                <div class="vue-modal-header">
                    <h5 class="vue-modal-header-caption">
                        <slot name="modal-header">Modal Header</slot>
                    </h5>
                </div>
                <div class="vue-modal-body">
                    <slot name="modal-body"></slot>
                </div>
                <div class="d-grid vue-modal-footer">
                    <slot name="modal-footer" :closeModal="dismiss">
                        <button @click="dismiss" type="button" class="btn btn-primary">
                            Close
                        </button>
                    </slot>
                </div>
                <i class="fas fa-times fa-1x vue-modal-close" @click="dismiss"></i>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            show: { required: true },
                preventBackgroundScrolling: { default: true }
        },
        data() {
            return {
                item: {},
            }
        },
        created() {
            const escapeHandler = e => {
                if (e.key === "Escape" && this.show) {
                    this.dismiss()
                }
            }
            document.addEventListener("keydown", escapeHandler)
           /*this.once("hook:destroyed", () => {
                document.removeEventListener("keydown", escapeHandler)
            })*/
        },
        watch: {
            show: {
                immediate: true,
                handler: function(show) {
                    if (show) {
                        this.preventBackgroundScrolling &&
                        document.body.style.setProperty("overflow", "hidden")
                    } else {
                        this.preventBackgroundScrolling &&
                        document.body.style.removeProperty("overflow")
                    }
                }
            }
        },
        methods: {
            dismiss() {
                this.$emit("close")
            },
        }
    }
</script>


