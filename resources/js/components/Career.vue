<template>
    <slot :careerSelected="careerSelected" :career="career"></slot>
</template>


<script setup>
import { ref } from 'vue';

var career = ref(null)

function careerSelected(value){
    career.value = value
}

/*watch(scareer.isCareerSelected, (newValue) => {
    if (newValue) {
        scareer.showSelectedCareer()

    }
});*/

/*
export default {

    computed: {
        isCareerSelected () {
            return scareer.isCareerSelected.value;
        }
    },

    watch: {
        isCareerSelected (newOption){
            if (newOption)
            {
                console.log(this.$slots.default()[0].ctx.refs)
            }
        }
    },
}*/

</script>
