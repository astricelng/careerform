<template>
    <div>
        <ul
            class="grid grid-cols-1 gap-x-5 gap-y-7 md:gap-y-10 md:grid-cols-2 xl:grid-cols-3 xl:justify-items-stretch"
            v-if="!loading"
            :class="[
				careerList && careerList.length > 1
					? 'md:justify-items-center'
					: '',
			]"
        >
            <li
                v-for="(career, index) in careerList"
                class="w-full flex flex-col col-span-1 max-w-sm h-55 md:h-60 group bg-white-200 transition duration-150 ease-in-out hover:bg-blue-dark rounded-[5px] cursor-pointer text-blue-dark p-7"
                :class="[
					index % 3 === 1
						? 'xl:mx-auto'
						: index % 3 === 2
						? 'xl:ml-auto'
						: '',
				]"
            >
                <div>
                    <h1
                        class="font-title font-medium text-lg md:text-xl leading-snug group-hover:text-white-100 uppercase transition duration-150 ease-in-out"
                    >
                        {{ career.title }}
                    </h1>
                    <button
                        class="flex leading-none underline bg-transparent group-hover:text-gray-300 mt-2.5 transition duration-150 ease-in-out"
                        @click="showMore(career)"
                    >
                        <span class="hover:text-white-100">Show more</span>
                    </button>
                    <p
                        class="leading-none group-hover:text-white-100 mt-7 transition duration-150 ease-in-out"
                    >
                        {{ career.vacancy }}
                        <span>{{
                                career.vacancy < 2 ? "vacant" : "vacancies"
                            }}</span>
                    </p>
                </div>
                <div class="flex-1 flex flex-row items-end justify-center">
                    <div
                        class="w-full flex flex-row items-center text-blue-dark group-hover:text-blue-light-400"
                    >
                        <div class="w-full h-px bg-blue-light-400"></div>
                        <button
                            class="min-w-23 w-full px-2 xl:px-5 hover:text-white-100 transition duration-150 ease-in-out"
                            @click="selectItem(career.id)"
                        >
                            Apply now!
                        </button>
                        <div class="w-full h-px bg-blue-light-400"></div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="w-full h-full flex items-center justify-center" v-else>
            <div class="w-full h-25 flex items-center justify-center">
                <div class="dot-loader"></div>
                <div class="dot-loader dot-loader--2"></div>
                <div class="dot-loader dot-loader--3"></div>
            </div>
        </div>

        <career-show-more
            ref="panelMore"
            :career="showItem"
            @applyCareer="selectItem"
        ></career-show-more>

    </div>

    <button type="button" ref="refbutton" @click="selectItem">hola</button>
    aqui el career list

</template>


<script setup>
import { ref, onMounted } from "vue";
import CareerShowMore from "./CareerShowMore.vue";

const emit = defineEmits(["itemSelected"]);

const careerList = ref(null);
const showItem = ref(null);
const loading = ref(false);
const panelMore = ref(null);

onMounted(() => {
    fetch();
});

function fetch() {
    loading.value = true;
    let url = "/career-list?";

    axios
        .get(url)
        .then((response) => {
            careerList.value = response.data.data;
        })
        .catch((error) => console.log(error))
        .finally(() => (loading.value = false));
}

function showMore(item) {
    showItem.value = item;

    panelMore.value.managaPanel("open");
}

function selectItem(value) {
    emit('itemSelected', value)
}

</script>
