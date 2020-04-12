<template>
    <div class="dropdown relative">
        <div @click="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>

        <div
            v-show="isOpen"
            class="dropdown-menu absolute bg-white py-2 rounded-lg mt-2 right-0"
            :class="align === 'left' ? 'left-0' : 'right-0'"
            :style="{ width }"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            align: { default: 'left' },
            width: { default: 'auto' }
        },

        data() {
            return {
                isOpen: false,
            };
        },

        watch: {
            isOpen(isOpen) {
                if (isOpen) {
                    document.addEventListener('click', this.closeIfClickedOutside);
                }
            }
        },

        methods: {
            closeIfClickedOutside(event) {
                if (! event.target.closest('.dropdown')) {
                    this.isOpen = false;
                    document.removeEventListener('click', this.closeIfClickedOutside);
                }
            }
        }
    }
</script>
