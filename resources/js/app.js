import { createApp } from "vue/dist/vue.esm-bundler";

const app = createApp({
    data() {
        return {

        }
    },
});

import Career from "./components/Career.vue";

app.component("Career", Career);
app.mount("#appp");
