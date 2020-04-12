<template>
    <div class="mr-8">
        <button
            v-for="(valueColor, keyThemeName) in themes"
            class="rounded-full p-3 border mr-2 focus:outline-none"
            :class="{ 'border-blue-500': selectedTheme == keyThemeName }"
            :style="{ backgroundColor: valueColor }"
            @click="selectedTheme = keyThemeName"
        ></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                themes: {
                    'theme-light': 'white',
                    'theme-dark': 'black',
                },

                selectedTheme: 'theme-light',
            };
        },

        created() {
            this.selectedTheme = localStorage.getItem('theme') || 'theme-light';
        },

        watch: {
            selectedTheme() {
                document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);

                localStorage.setItem('theme', this.selectedTheme);
            }
        },
    }
</script>
