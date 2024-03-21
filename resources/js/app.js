import { createApp } from "vue/dist/vue.esm-bundler";

const app = createApp({
    data() {
        return {

        }
    },
});

import TestC from "./components/test.vue";

app.component("TestC", TestC);
