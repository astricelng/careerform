<template>
    <div
        class="panel-showmore fixed z-30 inset-0 overflow-hidden"
        aria-labelledby="slide-over-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="overlay absolute inset-0 bg-white-100 bg-opacity-75 transition-opacity"
                aria-hidden="true"
            ></div>
            <div class="fixed inset-y-0 right-0 max-w-full flex">
                <div class="modal relative w-screen xl:max-w-2xl 3xl:max-w-3xl">
                    <div
                        class="btn_close-menu absolute w-12 h-12 md:w-18 md:h-18 top-0 right-0 xl:top-1/2 xl:-left-9 xl:right-auto bg-black xl:transform xl:-translate-y-1/2 group cursor-pointer"
                    >
                        <button
                            type="button"
                            class="w-full h-full flex justify-center items-center text-white-100 focus:outline-none"
                        >
                            <span class="sr-only">Close panel</span>
                            <!-- Heroicon name: outline/x -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-3 h-3 md:w-5 md:h-5 transition duration-300 ease-in-out transform group-hover:scale-125"
                                viewBox="0 0 22.828 22.828"
                            >
                                <path
                                    id="Trazado_442"
                                    data-name="Trazado 442"
                                    d="M6,26,26,6M6,6,26,26"
                                    transform="translate(-4.586 -4.586)"
                                    fill="none"
                                    stroke="#fff"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- HEADER -->

                    <div
                        class="h-full bg-white border-l border-gray-300 pt-10 pb-36 px-5 mx:px-10 xl:pl-18 xl:pr-25 overflow-y-scroll"
                    >
                        <div
                            class="md:w-3/4 xl:w-full flex flex-col md:mx-auto"
                            v-if="career"
                        >
                            <h2
                                class="font-title font-medium text-4xl text-blue-dark leading-custom"
                            >
                                {{ career.title }}
                            </h2>
                            <span class="text-blue-dark leading-none mt-5">
								{{ career.vacancy }}
								<span>{{
                                        career.vacancy < 2 ? "vacant" : "vacancies"
                                    }}</span></span
                            >

                            <div class="w-full mt-15">
                                <div class="flex flex-row items-center">
									<span
                                        class="min-w-34 font-title text-blue-dark leading-none uppercase"
                                    >Job Description</span
                                    >
                                    <div
                                        class="ml-2 w-full h-px bg-blue-light-400"
                                    ></div>
                                </div>
                                <div
                                    class="mt-7 space-y-5 text-blue-dark"
                                    v-html="career.description"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full bg-white-200 border-l border-gray-300 pb-7 xl:pl-18 xl:pr-25 xl:shadow-bar-apply"
                    >
                        <button
                            type="button"
                            class="btn_apply-show w-full h-11 3xl:h-13 text-white-100 bg-blue-dark rounded-3 md:rounded-5 rounded-br-3xl md:rounded-br-4xl transition duration-300 ease-in-out hover:ring-2 hover:ring-blue-dark"
                            @click="showApply()"
                        >
                            Apply now!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import gsap from "gsap";

export default {
    props: {
        career: {
            type: Object,
            default: null,
        },
    },
    emits: ["applyCareer"],
    setup(props, { emit }) {
        const status = ref("close");

        var tl = null;
        var modal = ".panel-showmore";

        onMounted(() => {
            tl = gsap.timeline();
            tl.set(modal, { autoAlpha: 0 });
            tl.set(modal + " .modal", { xPercent: 120 });

            document.querySelector(".btn_close-menu").addEventListener(
                "click",
                function () {
                    managaPanel("close");
                },
                false
            );
        });

        function managaPanel(statusM) {
            if (statusM === "open") {
                tl.to(modal, { autoAlpha: 1 })
                    .to(modal + " .overlay", {
                        duration: 0.3,
                        opacity: 0.75,
                    })
                    .to(modal + " .modal", {
                        duration: 0.3,
                        xPercent: 0,
                        delay: -0.3,
                    });

                document
                    .querySelector("body")
                    .classList.add("overflow-y-hidden");
            } else {
                tl.to(modal + " .overlay", { duration: 0.3, opacity: 0 })
                    .to(modal + " .modal", {
                        duration: 0.3,
                        xPercent: 120,
                    })
                    .to(modal, { autoAlpha: 0 });

                document
                    .querySelector("body")
                    .classList.remove("overflow-y-hidden");
            }

            status.value = statusM;
        }

        function showApply() {
            managaPanel("close");
            emit("applyCareer", props.career);
        }

        return {
            showApply,
            managaPanel,
        };
    },
};
</script>
