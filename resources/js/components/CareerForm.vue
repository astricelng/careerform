<template>
    <slot></slot>
</template>


<script setup>
import {watch, onMounted, getCurrentInstance} from "vue";

const props = defineProps({
    career: {
        type: String,
        default: null,
    }
});

const instance = getCurrentInstance();
var refEntry = null;

watch(
    () => props.career,
    (newValue) => {
        refEntry.selectOptionFromOutside(newValue);
    }
);

onMounted(()=>{
    refEntry = instance.subTree?.children[0].ctx.refs['refEntryjob_position'];
})


/*import {onMounted, ref, useSlots, watch, getCurrentInstance } from 'vue';

const props = defineProps({
    career: {
        type: String,
        default: null,
    },
});

watch(
    () => props.career,
    (newValue) => {
        alert(newValue);

    }
);

onMounted( () => {
    //const slots = useSlots();
    //console.log( slots.default()[0].children[2].children[0].children[1]);
    const instance = getCurrentInstance();
    console.log(instance)
})*/

</script>
